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

// var inputElement = document.getElementById('tags');
// new Tagify(inputElement)
var tagify = new Tagify(document.getElementById('tags'), {
    delimiters: null,
    templates: {
        tag: function (tagData) {
            try {
                return `<tag title='${tagData.value}' contenteditable='false' spellcheck="false" class='tagify__tag ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}>
                        <x title='remove tag' class='tagify__tag__removeBtn'></x>
                        <div>
                            ${tagData.code ?
                        `<img onerror="this.style.visibility='hidden'" src='https://flagicons.lipis.dev/flags/4x3/${tagData.code.toLowerCase()}.svg'>` : ''
                    }
                            <span class='tagify__tag-text'>${tagData.value}</span>
                        </div>
                    </tag>`
            }
            catch (err) { }
        },

        dropdownItem: function (tagData) {
            try {
                return `<div ${this.getAttributes(tagData)} class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}' >
                            <img onerror="this.style.visibility = 'hidden'"
                                src='https://flagicons.lipis.dev/flags/4x3/${tagData.code.toLowerCase()}.svg'>
                            <span>${tagData.value}</span>
                        </div>`
            }
            catch (err) { console.error(err) }
        }
    },
    enforceWhitelist: true,
    whitelist: [
        { value: 'Afghanistan', code: 'AF' },
        { value: 'Åland Islands', code: 'AX' },
        { value: 'Albania', code: 'AL' },
        { value: 'Algeria', code: 'DZ' },
        { value: 'American Samoa', code: 'AS' },
        { value: 'Andorra', code: 'AD' },
        { value: 'Angola', code: 'AO' },
        { value: 'Anguilla', code: 'AI' },
        { value: 'Antarctica', code: 'AQ' },
        { value: 'Antigua and Barbuda', code: 'AG' },
        { value: 'Argentina', code: 'AR' },
        { value: 'Armenia', code: 'AM' },
        { value: 'Aruba', code: 'AW' },
        { value: 'Australia', code: 'AU', searchBy: 'beach, sub-tropical' },
        { value: 'Austria', code: 'AT' },
        { value: 'Azerbaijan', code: 'AZ' },
        { value: 'Bahamas', code: 'BS' },
        { value: 'Bahrain', code: 'BH' },
        { value: 'Bangladesh', code: 'BD' },
        { value: 'Barbados', code: 'BB' },
        { value: 'Belarus', code: 'BY' },
        { value: 'Belgium', code: 'BE' },
        { value: 'Belize', code: 'BZ' },
        { value: 'Benin', code: 'BJ' },
        { value: 'Bermuda', code: 'BM' },
        { value: 'Bhutan', code: 'BT' },
        { value: 'Bolivia', code: 'BO' },
        { value: 'Bosnia and Herzegovina', code: 'BA' },
        { value: 'Botswana', code: 'BW' },
        { value: 'Bouvet Island', code: 'BV' },
        { value: 'Brazil', code: 'BR' },
        { value: 'British Indian Ocean Territory', code: 'IO' },
        { value: 'Brunei Darussalam', code: 'BN' },
        { value: 'Bulgaria', code: 'BG' },
        { value: 'Burkina Faso', code: 'BF' },
        { value: 'Burundi', code: 'BI' },
        { value: 'Cambodia', code: 'KH' },
        { value: 'Cameroon', code: 'CM' },
        { value: 'Canada', code: 'CA' },
        { value: 'Cape Verde', code: 'CV' },
        { value: 'Cayman Islands', code: 'KY' },
        { value: 'Central African Republic', code: 'CF' },
        { value: 'Chad', code: 'TD' },
        { value: 'Chile', code: 'CL' },
        { value: 'China', code: 'CN' },
        { value: 'Christmas Island', code: 'CX' },
        { value: 'Cocos (Keeling) Islands', code: 'CC' },
        { value: 'Colombia', code: 'CO' },
        { value: 'Comoros', code: 'KM' },
        { value: 'Congo', code: 'CG' },
        { value: 'Congo, The Democratic Republic of the', code: 'CD' },
        { value: 'Cook Islands', code: 'CK' },
        { value: 'Costa Rica', code: 'CR' },
        { value: 'Cote D\'Ivoire', code: 'CI' },
        { value: 'Croatia', code: 'HR' },
        { value: 'Cuba', code: 'CU' },
        { value: 'Cyprus', code: 'CY' },
        { value: 'Czech Republic', code: 'CZ' },
        { value: 'Denmark', code: 'DK' },
        { value: 'Djibouti', code: 'DJ' },
        { value: 'Dominica', code: 'DM' },
        { value: 'Dominican Republic', code: 'DO' },
        { value: 'Ecuador', code: 'EC' },
        { value: 'Egypt', code: 'EG' },
        { value: 'El Salvador', code: 'SV' },
        { value: 'Equatorial Guinea', code: 'GQ' },
        { value: 'Eritrea', code: 'ER' },
        { value: 'Estonia', code: 'EE' },
        { value: 'Ethiopia', code: 'ET' },
        { value: 'Falkland Islands (Malvinas)', code: 'FK' },
        { value: 'Faroe Islands', code: 'FO' },
        { value: 'Fiji', code: 'FJ' },
        { value: 'Finland', code: 'FI' },
        { value: 'France', code: 'FR' },
        { value: 'French Guiana', code: 'GF' },
        { value: 'French Polynesia', code: 'PF' },
        { value: 'French Southern Territories', code: 'TF' },
        { value: 'Gabon', code: 'GA' },
        { value: 'Gambia', code: 'GM' },
        { value: 'Georgia', code: 'GE' },
        { value: 'Germany', code: 'DE' },
        { value: 'Ghana', code: 'GH' },
        { value: 'Gibraltar', code: 'GI' },
        { value: 'Greece', code: 'GR' },
        { value: 'Greenland', code: 'GL' },
        { value: 'Grenada', code: 'GD' },
        { value: 'Guadeloupe', code: 'GP' },
        { value: 'Guam', code: 'GU' },
        { value: 'Guatemala', code: 'GT' },
        { value: 'Guernsey', code: 'GG' },
        { value: 'Guinea', code: 'GN' },
        { value: 'Guinea-Bissau', code: 'GW' },
        { value: 'Guyana', code: 'GY' },
        { value: 'Haiti', code: 'HT' },
        { value: 'Heard Island and Mcdonald Islands', code: 'HM' },
        { value: 'Holy See (Vatican City State)', code: 'VA' },
        { value: 'Honduras', code: 'HN' },
        { value: 'Hong Kong', code: 'HK' },
        { value: 'Hungary', code: 'HU' },
        { value: 'Iceland', code: 'IS' },
        { value: 'India', code: 'IN' },
        { value: 'Indonesia', code: 'ID' },
        { value: 'Iran, Islamic Republic Of', code: 'IR' },
        { value: 'Iraq', code: 'IQ' },
        { value: 'Ireland', code: 'IE' },
        { value: 'Isle of Man', code: 'IM' },
        { value: 'Israel', code: 'IL', searchBy: 'holy land, desert' },
        { value: 'Italy', code: 'IT' },
        { value: 'Jamaica', code: 'JM' },
        { value: 'Japan', code: 'JP' },
        { value: 'Jersey', code: 'JE' },
        { value: 'Jordan', code: 'JO' },
        { value: 'Kazakhstan', code: 'KZ' },
        { value: 'Kenya', code: 'KE' },
        { value: 'Kiribati', code: 'KI' },
        { value: 'Korea, Democratic People\'S Republic of', code: 'KP' },
        { value: 'Korea, Republic of', code: 'KR' },
        { value: 'Kuwait', code: 'KW' },
        { value: 'Kyrgyzstan', code: 'KG' },
        { value: 'Lao People\'S Democratic Republic', code: 'LA' },
        { value: 'Latvia', code: 'LV' },
        { value: 'Lebanon', code: 'LB' },
        { value: 'Lesotho', code: 'LS' },
        { value: 'Liberia', code: 'LR' },
        { value: 'Libyan Arab Jamahiriya', code: 'LY' },
        { value: 'Liechtenstein', code: 'LI' },
        { value: 'Lithuania', code: 'LT' },
        { value: 'Luxembourg', code: 'LU' },
        { value: 'Macao', code: 'MO' },
        { value: 'Macedonia, The Former Yugoslav Republic of', code: 'MK' },
        { value: 'Madagascar', code: 'MG' },
        { value: 'Malawi', code: 'MW' },
        { value: 'Malaysia', code: 'MY' },
        { value: 'Maldives', code: 'MV' },
        { value: 'Mali', code: 'ML' },
        { value: 'Malta', code: 'MT' },
        { value: 'Marshall Islands', code: 'MH' },
        { value: 'Martinique', code: 'MQ' },
        { value: 'Mauritania', code: 'MR' },
        { value: 'Mauritius', code: 'MU' },
        { value: 'Mayotte', code: 'YT' },
        { value: 'Mexico', code: 'MX' },
        { value: 'Micronesia, Federated States of', code: 'FM' },
        { value: 'Moldova, Republic of', code: 'MD' },
        { value: 'Monaco', code: 'MC' },
        { value: 'Mongolia', code: 'MN' },
        { value: 'Montserrat', code: 'MS' },
        { value: 'Morocco', code: 'MA' },
        { value: 'Mozambique', code: 'MZ' },
        { value: 'Myanmar', code: 'MM' },
        { value: 'Namibia', code: 'NA' },
        { value: 'Nauru', code: 'NR' },
        { value: 'Nepal', code: 'NP' },
        { value: 'Netherlands', code: 'NL' },
        { value: 'Netherlands Antilles', code: 'AN' },
        { value: 'New Caledonia', code: 'NC' },
        { value: 'New Zealand', code: 'NZ' },
        { value: 'Nicaragua', code: 'NI' },
        { value: 'Niger', code: 'NE' },
        { value: 'Nigeria', code: 'NG' },
        { value: 'Niue', code: 'NU' },
        { value: 'Norfolk Island', code: 'NF' },
        { value: 'Northern Mariana Islands', code: 'MP' },
        { value: 'Norway', code: 'NO' },
        { value: 'Oman', code: 'OM' },
        { value: 'Pakistan', code: 'PK' },
        { value: 'Palau', code: 'PW' },
        { value: 'Palestinian Territory, Occupied', code: 'PS' },
        { value: 'Panama', code: 'PA' },
        { value: 'Papua New Guinea', code: 'PG' },
        { value: 'Paraguay', code: 'PY' },
        { value: 'Peru', code: 'PE' },
        { value: 'Philippines', code: 'PH' },
        { value: 'Pitcairn', code: 'PN' },
        { value: 'Poland', code: 'PL' },
        { value: 'Portugal', code: 'PT' },
        { value: 'Puerto Rico', code: 'PR' },
        { value: 'Qatar', code: 'QA' },
        { value: 'Reunion', code: 'RE' },
        { value: 'Romania', code: 'RO' },
        { value: 'Russian Federation', code: 'RU' },
        { value: 'RWANDA', code: 'RW' },
        { value: 'Saint Helena', code: 'SH' },
        { value: 'Saint Kitts and Nevis', code: 'KN' },
        { value: 'Saint Lucia', code: 'LC' },
        { value: 'Saint Pierre and Miquelon', code: 'PM' },
        { value: 'Saint Vincent and the Grenadines', code: 'VC' },
        { value: 'Samoa', code: 'WS' },
        { value: 'San Marino', code: 'SM' },
        { value: 'Sao Tome and Principe', code: 'ST' },
        { value: 'Saudi Arabia', code: 'SA' },
        { value: 'Senegal', code: 'SN' },
        { value: 'Serbia and Montenegro', code: 'CS' },
        { value: 'Seychelles', code: 'SC' },
        { value: 'Sierra Leone', code: 'SL' },
        { value: 'Singapore', code: 'SG' },
        { value: 'Slovakia', code: 'SK' },
        { value: 'Slovenia', code: 'SI' },
        { value: 'Solomon Islands', code: 'SB' },
        { value: 'Somalia', code: 'SO' },
        { value: 'South Africa', code: 'ZA' },
        { value: 'South Georgia and the South Sandwich Islands', code: 'GS' },
        { value: 'Spain', code: 'ES' },
        { value: 'Sri Lanka', code: 'LK' },
        { value: 'Sudan', code: 'SD' },
        { value: 'Suriname', code: 'SR' },
        { value: 'Svalbard and Jan Mayen', code: 'SJ' },
        { value: 'Swaziland', code: 'SZ' },
        { value: 'Sweden', code: 'SE' },
        { value: 'Switzerland', code: 'CH' },
        { value: 'Syrian Arab Republic', code: 'SY' },
        { value: 'Taiwan', code: 'TW' },
        { value: 'Tajikistan', code: 'TJ' },
        { value: 'Tanzania, United Republic of', code: 'TZ' },
        { value: 'Thailand', code: 'TH' },
        { value: 'Timor-Leste', code: 'TL' },
        { value: 'Togo', code: 'TG' },
        { value: 'Tokelau', code: 'TK' },
        { value: 'Tonga', code: 'TO' },
        { value: 'Trinidad and Tobago', code: 'TT' },
        { value: 'Tunisia', code: 'TN' },
        { value: 'Turkey', code: 'TR' },
        { value: 'Turkmenistan', code: 'TM' },
        { value: 'Turks and Caicos Islands', code: 'TC' },
        { value: 'Tuvalu', code: 'TV' },
        { value: 'Uganda', code: 'UG' },
        { value: 'Ukraine', code: 'UA' },
        { value: 'United Arab Emirates', code: 'AE' },
        { value: 'United Kingdom', code: 'GB' },
        { value: 'United States', code: 'US' },
        { value: 'United States Minor Outlying Islands', code: 'UM' },
        { value: 'Uruguay', code: 'UY' },
        { value: 'Uzbekistan', code: 'UZ' },
        { value: 'Vanuatu', code: 'VU' },
        { value: 'Venezuela', code: 'VE' },
        { value: 'Viet Nam', code: 'VN' },
        { value: 'Virgin Islands, British', code: 'VG' },
        { value: 'Virgin Islands, U.S.', code: 'VI' },
        { value: 'Wallis and Futuna', code: 'WF' },
        { value: 'Western Sahara', code: 'EH' },
        { value: 'Yemen', code: 'YE' },
        { value: 'Zambia', code: 'ZM' },
        { value: 'Zimbabwe', code: 'ZW' }
    ],
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
Alpine.plugin(slug)
window.Alpine = Alpine;

Alpine.start();
