function toggleRemoveButton(checkbox) {
    var removeButton = checkbox.parentElement.querySelector('.remove-button');
    removeButton.style.display = checkbox.checked ? 'block' : 'none';
}

function removeNote(id) {
    var confirmation = confirm('Are you sure you want to unarchive this note?');
    if (confirmation) {
        // Send an AJAX request to unarchive the note
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Reload the page after successful unarchiving
                    window.location.reload();
                } else {
                    // Display an error message if unarchiving fails
                    alert('Error: Unable to unarchive the note.');
                }
            }
        };
        xhr.open('GET', 'unarchive_note.php?id=' + id, true);
        xhr.send();
    }
}

function deleteAllNotes() {
    var confirmation = confirm('Are you sure you want to delete all archived notes?');
    if (confirmation) {
        // Send an AJAX request to delete all archived notes
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Reload the page after successful deletion
                    window.location.reload();
                } else {
                    // Display an error message if deletion fails
                    alert('Error: Unable to delete all archived notes.');
                }
            }
        };
        xhr.open('GET', 'delete_all_notes.php', true); 
        xhr.send();
    }
}