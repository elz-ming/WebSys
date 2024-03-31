document.addEventListener('DOMContentLoaded', function() {
    /* ++++++++++++++++++++ menu sidebar ++++++++++++++++++++ */
    const menuLinks = document.querySelectorAll('.menu a');
    
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tableName = this.getAttribute('href').split('=')[1];
            
            fetch('/asset/php/admin/getTable.php?table=' + tableName)
            .then(response => response.text())
            .then(html => {
                document.querySelector('.content').innerHTML = html;
                attachDynamicButtonListeners(); // Re-attach event listeners for dynamic content
            })
            .catch(error => console.error('Error:', error));
        });
    });

    /* ++++++++++++++++++++ popup menu ++++++++++++++++++++ */
    let currentAction = '';
    let currentItemId = null;
    let currentTableName = null;

    // Close modal functionality
    document.querySelector('.close-btn').addEventListener('click', closeModal);
    document.querySelector('.cancel-btn').addEventListener('click', closeModal);
    
        // Dynamic action button event listener
        document.getElementById('actionBtn').addEventListener('click', performAction);

    // Attach listeners to dynamic buttons
    function attachDynamicButtonListeners() {
        document.getElementById('add-btn').addEventListener('click', function() {
            const tableName = this.getAttribute('data-table');
            openModal('add', null, tableName);
        });

        document.querySelectorAll('.edit-btn').forEach(btn => btn.addEventListener('click', () => openModal('edit', btn.dataset.id, btn.dataset.table)));
        document.querySelectorAll('.delete-btn').forEach(btn => btn.addEventListener('click', () => openModal('delete', btn.dataset.id, btn.dataset.table)));
    }

    attachDynamicButtonListeners(); // Call this here to attach listeners on initial page load
});

function openModal(action, itemId = null, tableName = null) {
    currentAction = action;
    currentItemId = itemId;
    currentTableName = tableName;
    const modalBody = document.getElementById('modalBody');
    const actionBtn = document.getElementById('actionBtn');

    // Configure the modal based on the action
    switch (action) {
        case 'add':
            let formHtml = '';
            if (currentTableName === 'blog') {
                formHtml = `
                    <form id="addBlogForm">
                        <label for="user_id">User ID:</label>
                        <input type="number" id="user_id" name="user_id" required><br>
                        
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required><br>
                        
                        <label for="subtitle">Subtitle:</label>
                        <input type="text" id="subtitle" name="subtitle"><br>
                        
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" required><br>
                        
                        <label for="category">Category:</label>
                        <input type="text" id="category" name="category" required><br>
                        
                        <label for="para_intro">Introduction Paragraph:</label>
                        <textarea id="para_intro" name="para_intro"></textarea><br>
                        
                        <label for="heading_1">1st Section Heading:</label>
                        <input type="text" id="heading_1" name="heading_1"><br>
                        
                        <label for="para_1">1st Paragraph:</label>
                        <textarea id="para_1" name="para_1"></textarea><br>
                        
                        <label for="heading_2">2nd Section Heading:</label>
                        <input type="text" id="heading_2" name="heading_2"><br>
                        
                        <label for="para_2">2nd Paragraph:</label>
                        <textarea id="para_2" name="para_2"></textarea><br>
                        
                        <label for="heading_3">3rd Section Heading:</label>
                        <input type="text" id="heading_3" name="heading_3"><br>
                        
                        <label for="para_3">3rd Paragraph:</label>
                        <textarea id="para_3" name="para_3"></textarea><br>
                        
                        <label for="image_path">Image Path:</label>
                        <input type="text" id="image_path" name="image_path"><br>
                    </form>
                `;
            } else if (currentTableName === 'package') {
                formHtml = `
                    <form id="addPackageForm">
                        <label for="blog_id">Blog ID:</label>
                        <input type="number" id="blog_id" name="blog_id" required><br>
                        
                        <label for="pname">Package Name:</label>
                        <input type="text" id="pname" name="pname" required><br>
                        
                        <label for="content">Content:</label>
                        <textarea id="content" name="content"></textarea><br>
                        
                        <label for="destination">Destination:</label>
                        <input type="text" id="destination" name="destination" required><br>
                        
                        <label for="duration">Duration:</label>
                        <input type="text" id="duration" name="duration" required><br>
                        
                        <label for="price">Price:</label>
                        <input type="text" id="price" name="price" required><br>
                        
                        <label for="image_path">Image Path:</label>
                        <input type="text" id="image_path" name="image_path"><br>
                    </form>
                `;
            }

            modalBody.innerHTML = formHtml;
            actionBtn.textContent = 'Add';
            actionBtn.className = 'action-btn green';
        break;

        case 'edit':
            let fetchUrl = '';
            
            if (currentTableName === 'blog') {
                fetchUrl = `/asset/php/admin/getBlog.php?id=${currentItemId}`;
            } else if (currentTableName === 'package') {
                fetchUrl = `/asset/php/admin/getPackage.php?id=${currentItemId}`;
            }

            console.log(currentItemId);
        
            fetch(fetchUrl)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                    return;
                }

                // Generate form HTML dynamically based on the fetched data
                let formHtml = '';
                if (currentTableName === 'blog') {
                    formHtml = `
                        <form id="addBlogForm">
                            <label for="user_id">User ID:</label>
                            <input type="number" id="user_id" name="user_id" value="${data.user_id}" required><br>
                            
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" value="${data.title}" required><br>
                            
                            <label for="subtitle">Subtitle:</label>
                            <input type="text" id="subtitle" name="subtitle" value="${data.subtitle}"><br>
                            
                            <label for="country">Country:</label>
                            <input type="text" id="country" name="country" value="${data.country}" required><br>
                            
                            <label for="category">Category:</label>
                            <input type="text" id="category" name="category" value="${data.category}" required><br>
                            
                            <label for="para_intro">Introduction Paragraph:</label>
                            <textarea id="para_intro" name="para_intro">${data.para_intro}</textarea><br>
                            
                            <label for="heading_1">1st Section Heading:</label>
                            <input type="text" id="heading_1" name="heading_1" value="${data.heading_1}" ><br>
                            
                            <label for="para_1">1st Paragraph:</label>
                            <textarea id="para_1" name="para_1">${data.para_1}</textarea><br>
                            
                            <label for="heading_2">2nd Section Heading:</label>
                            <input type="text" id="heading_2" name="heading_2" value="${data.heading_2}" ><br>
                            
                            <label for="para_2">2nd Paragraph:</label>
                            <textarea id="para_2" name="para_2">${data.para_2}</textarea><br>
                            
                            <label for="heading_3">3rd Section Heading:</label>
                            <input type="text" id="heading_3" name="heading_3" value="${data.heading_3}" ><br>
                            
                            <label for="para_3">3rd Paragraph:</label>
                            <textarea id="para_3" name="para_3">${data.para_3}</textarea><br>
                            
                            <label for="image_path">Image Path:</label>
                            <input type="text" id="image_path" name="image_path" value="${data.image_path}"><br>
                        </form>
                    `;
                } else if (currentTableName === 'package') {
                    console.log(currentTableName);
                    formHtml = `
                        <form id="addPackageForm">
                            <label for="blog_id">Blog ID:</label>
                            <input type="number" id="blog_id" name="blog_id" value="${data.blog_id}" required><br>
                            
                            <label for="pname">Package Name:</label>
                            <input type="text" id="pname" name="pname" value="${data.pname}" required><br>
                            
                            <label for="content">Content:</label>
                            <textarea id="content" name="content">${data.content}</textarea><br>
                            
                            <label for="destination">Destination:</label>
                            <input type="text" id="destination" name="destination" value="${data.destination}" required><br>
                            
                            <label for="duration">Duration:</label>
                            <input type="text" id="duration" name="duration" value="${data.duration}" required><br>
                            
                            <label for="price">Price:</label>
                            <input type="text" id="price" name="price" value="${data.price}" required><br>
                            
                            <label for="image_path">Image Path:</label>
                            <input type="text" id="image_path"  name="image_path" value="${data.image_path}"><br>
                        </form>
                    `;
                }
                modalBody.innerHTML = formHtml;
                actionBtn.textContent = 'Save Changes';
                actionBtn.className = 'action-btn yellow';
            }).catch(error => console.error('Error fetching item details:', error));    
        break;

        case 'delete':
            modalBody.innerHTML = 'Confirm delete?';
            actionBtn.textContent = 'Delete';
            actionBtn.className = 'action-btn red';
        break;
    }

    document.getElementById('actionModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('actionModal').style.display = 'none';
}

function performAction() {
    console.log('Performing', currentAction, 'action');
    const modalBody = document.getElementById('modalBody');
    let form = '';
    let formData = '';
    let endpoint = '';

    switch (currentAction) {
        case 'add':
            form = modalBody.querySelector('form');
            formData = new FormData(form);
            endpoint = '';

            // Determine the correct endpoint based on the table name
            if (currentTableName === 'blog') {
                endpoint = '/asset/php/admin/addBlog.php';
            } else if (currentTableName === 'package') {
                endpoint = '/asset/php/admin/addPackage.php';
            }

            // AJAX request to add the new item
            fetch(endpoint, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Successfully added the new item.');
                    // Refresh the data
                    location.reload();
                } else {
                    alert('Failed to add the new item. ' + (data.message || ''));
                }
            })
            .catch(error => console.error('Error:', error));
        break;

        case 'edit':
            form = modalBody.querySelector('form');
            formData = new FormData(form);
            formData.append('id', currentItemId);
            endpoint = '';

            // Determine the correct endpoint based on the table name
            if (currentTableName === 'blog') {
                endpoint = '/asset/php/admin/editBlog.php';
            } else if (currentTableName === 'package') {
                endpoint = '/asset/php/admin/editPackage.php';
            }

            // AJAX request to edit the item
            fetch(endpoint, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Successfully edited the item.');
                    // Refresh the data
                    location.reload();
                } else {
                    alert('Failed to edit the item. ' + (data.message || ''));
                }
            })
            .catch(error => console.error('Error:', error));
        break;

        case 'delete':
            if (!confirm('Confirm delete?')) {
                return; // Stop if the user cancels
            }
    
            // AJAX request to the server to delete the item
            fetch('/asset/php/admin/deleteItem.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: currentItemId, table: currentTableName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the row from the table
                    document.querySelector(`tr[data-id="${currentItemId}"]`).remove();
                } else {
                    alert('Delete failed: ' + data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        break;
    }

    closeModal();
}