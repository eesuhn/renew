document.getElementById('file-input').addEventListener('change', function() {
    var fileName = this.value.split('\\').pop();
    document.getElementById('file-name').innerHTML = fileName ? fileName : 'No file chosen';
});

