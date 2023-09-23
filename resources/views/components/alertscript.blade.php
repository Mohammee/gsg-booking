<script>
    function alertcolsed() {
        let alert = document.getElementById('alert');
        // Apply the transformation (translateX)
        alert.style.transform = 'translateX(400px)';

        setTimeout(function() {
            alert.style.display = 'none';
        }, 300);
    }

    let alert = document.getElementById('alert');

    setTimeout(function() {
        alert.style.transform = 'translateX(400px)';
        setTimeout(function() {
            alert.style.display = 'none';
        }, 300);
    }, 3000);
</script>
