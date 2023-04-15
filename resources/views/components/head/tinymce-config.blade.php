<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        skin: (localStorage.getItem('color-theme') === 'dark' ? "oxide-dark" : "oxide"),
        content_css: (localStorage.getItem('color-theme') === 'dark' ? "dark" : ""),
        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>
