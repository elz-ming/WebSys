document.querySelectorAll('[data-package-id]').forEach(button => {
    button.addEventListener('click', function() {
        const packageId = this.getAttribute('data-package-id');
        fetch('get_package_details.php?package_id=' + packageId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').innerText = 'Package Details - ' + data.pname;
                document.getElementById('modalImage').src = data.image_path;
                document.getElementById('modalPrice').innerText = '$' + data.price;
                document.getElementById('modalDestination').innerText = data.destination;
                document.getElementById('modalDuration').innerText = data.duration;
                document.getElementById('modalContent').innerText = data.content;
                document.getElementById('modalBookNow').href = 'checkout.php?package_id=' + data.id;
            });
    });
});
