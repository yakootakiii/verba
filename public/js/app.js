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
