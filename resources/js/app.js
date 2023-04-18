import './bootstrap';
import 'flowbite';
import './style.css';
import '@yaireo/tagify/dist/tagify.css';
import './sidebar';
import './charts';
import './dark-mode';
import './tagify-config';
import Datepicker from 'flowbite-datepicker/Datepicker';

import Alpine from 'alpinejs';
import slug from 'alpinejs-slug'



Alpine.plugin(slug)
window.Alpine = Alpine;

Alpine.start();
