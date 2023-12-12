const clickButtonEl = document.getElementById('edit-button');
const modal = document.getElementById('modal');
const cancelButtonEl = document.getElementById('cancel');
const saveButtonEl = document.getElementById('save');

console.log('edit')

function clickButton(button, name, callback) {
    try {
        button.addEventListener('click', () => {
            callback();
        })
    }
    catch(err) {
        throw new Error(button + 'element is null check if the element has an id of' + name)
    }
}

function openModal() {
    if(modal.classList.contains('hidden')){
        modal.classList.remove('hidden')
        modal.classList.add('block')
    } else {
        modal.classList.remove('block')
        modal.classList.add('hidden')
    }
}

function closeModal() {
    if(modal.classList.contains('block')){
        modal.classList.remove('block')
        modal.classList.add('hidden')
    }
}

clickButton(clickButtonEl, 'edit-button', openModal)
clickButton(cancelButtonEl, 'cancel', closeModal)
clickButton(saveButtonEl, 'save', closeModal)
