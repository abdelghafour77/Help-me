import './bootstrap';
import 'flowbite';
import './style.css';
import '@yaireo/tagify/dist/tagify.css';
import './sidebar';
import './charts';
import './dark-mode';
import Datepicker from 'flowbite-datepicker/Datepicker';

import Alpine from 'alpinejs';
import slug from 'alpinejs-slug'
import Tagify from '@yaireo/tagify'


$.ajax({
    url: '/admin/tags',
    method: 'GET',

    success: function (response) {
        var clist = response;
        var a = clist.map(item => ({
            id: item.id,
            value: item.name,
            color: item.color
        }))
        // console.log(a)
        populateList(a);
    }
});

function populateList(clist) {
    var tagify = new Tagify(document.getElementById('tags'), {
        delimiters: null,
        templates: {
            tag: function (tagData) {
                try {
                    return `<tag title='${tagData.value}' contenteditable='false' spellcheck="false" class='tagify__tag rounded-full bg-${tagData.color ? tagData.color : ""}' ${this.getAttributes(tagData)}>
                        <x title='remove tag' class='tagify__tag__removeBtn'></x>
                        <div>
                            <span class='tagify__tag-text ${(parseInt(tagData.color.split("-")[1]) > 500) ? 'text-white' : 'text-black'}'>${tagData.value}</span>
                        </div>
                    </tag>`
                }
                catch (err) { }
            },

            dropdownItem: function (tagData) {
                try {
                    return `<div ${this.getAttributes(tagData)} class='tagify__dropdown__item' >
                            <img onerror="this.style.visibility = 'hidden'">
                            <span>${tagData.value}</span>
                        </div>`
                }
                catch (err) { console.error(err) }
            }
        },
        enforceWhitelist: true,
        whitelist: clist,
        dropdown: {
            enabled: 1, // suggest tags after a single character input
            classname: 'extra-properties' // custom class for the suggestions dropdown
        } // map tags' values to this property name, so this property will be the actual value and not the printed value on the screen
    })

    tagify.on('click', function (e) {
        console.log(e.detail);
    });

    tagify.on('remove', function (e) {
        console.log(e.detail);
    });

    tagify.on('add', function (e) {
        console.log("original Input:", tagify.DOM.originalInput);
        console.log("original Input's value:", tagify.DOM.originalInput.value);
        console.log("event detail:", e.detail);
    });

    // add the first 2 tags and makes them readonly
    var tagsToAdd = tagify.whitelist.slice(0, 2)
    tagify.addTags(tagsToAdd)
}





Alpine.plugin(slug)
window.Alpine = Alpine;

Alpine.start();
