// Modal Controls
function showModal() {
    const modal = document.getElementById('modal');
    if (modal) modal.classList.add('active');
}

function hideModal() {
    const modal = document.getElementById('modal');
    if (modal) modal.classList.remove('active');
}

function proceedToComment() {
    hideModal();
    alert('This would open the comment form. Modal validation passed!');
}

let deleteFormId = null;

function openDeleteModal(workId) {
    deleteFormId = `delete-form-${workId}`;
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDeleteModal() {
    deleteFormId = null;
    document.getElementById('delete-modal').classList.add('hidden');
}

document.getElementById('modal-confirm-delete').addEventListener('click', function () {
    if (deleteFormId) {
        document.getElementById(deleteFormId).submit();
    }
});

// DELETE MODAL
let activeDeleteId = null;

function openDeleteModal(id) {
    activeDeleteId = id;
    document.getElementById("delete-modal").classList.remove("hidden");
}

function closeDeleteModal() {
    document.getElementById("delete-modal").classList.add("hidden");
}

// When "Delete" is confirmed
document.getElementById("modal-confirm-delete").addEventListener("click", function () {
    if (activeDeleteId) {
        document.getElementById(`delete-form-${activeDeleteId}`).submit();
    }
});

// PROFILE EDIT MODAL
function openProfileModal() {
    document.getElementById("profile-modal").classList.remove("hidden");
}

function closeProfileModal() {
    document.getElementById("profile-modal").classList.add("hidden");
}

function openWriterModal() {
    document.getElementById('writer-modal').classList.remove('hidden');
}
function closeWriterModal() {
    document.getElementById('writer-modal').classList.add('hidden');
}