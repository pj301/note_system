function toggleRemoveButton(checkbox) {
    var removeButton = document.querySelector('.remove-button');
    removeButton.style.display = document.querySelectorAll('.note-checkbox:checked').length > 0 ? 'block' : 'none';
}

function removeSelectedNotes() {
    var selectedNotes = document.querySelectorAll('.note-checkbox:checked');
    selectedNotes.forEach(function(checkbox) {
        var noteId = checkbox.getAttribute('data-note-id');
       
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'remove_favorite.php?id=' + noteId, true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                
                window.location.reload();
            } else {
                
                console.error('Error removing note:', xhr.responseText);
            }
        };
        xhr.send();
    });
}