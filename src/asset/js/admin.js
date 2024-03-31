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
        document.getElementById('add-btn').addEventListener('click', () => openModal('add'));
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
            modalBody.innerHTML = 'Add new entry form here';
            actionBtn.textContent = 'Add';
            actionBtn.className = 'action-btn green';
        break;

        case 'edit':
            modalBody.innerHTML = 'Edit form here with values filled in for item ' + itemId;
            actionBtn.textContent = 'Save Changes';
            actionBtn.className = 'action-btn yellow';
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
    switch (currentAction) {
        case 'add':
            modalBody.innerHTML = 'Add new entry form here';
            actionBtn.textContent = 'Add';
            actionBtn.className = 'action-btn green';
        break;

        case 'edit':
            modalBody.innerHTML = 'Edit form here with values filled in for item ' + itemId;
            actionBtn.textContent = 'Save Changes';
            actionBtn.className = 'action-btn yellow';
        break;

        case 'delete':
            if (!confirm('Confirm delete?')) {
                return; // Stop if the user cancels
            }

            console.log('Deleting', currentItemId, 'from', currentTableName);
    
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