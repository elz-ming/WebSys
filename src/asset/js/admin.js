document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.menu a');
    
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tableName = this.getAttribute('href').split('=')[1];
            
            fetch('getTable.php?table=' + tableName)
            .then(response => response.text())
            .then(html => {
                document.querySelector('.content').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
        });
    });
});