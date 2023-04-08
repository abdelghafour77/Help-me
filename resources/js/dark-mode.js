
// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark') {
    document.documentElement.classList.add('dark');

} else if (localStorage.getItem('color-theme') === 'light') {
    document.documentElement.classList.remove('dark');
}

