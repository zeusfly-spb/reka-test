let ownItems = []
let mode = null

const itemModal = document.getElementById('itemModal')
const modalBodyInput = itemModal.querySelector('.modal-body input')
const clearInput = () => modalBodyInput.value = ''
const cancelButton = document.getElementById('cancel-button')
const saveButton = document.getElementById('save-button')
cancelButton.addEventListener('click', clearInput)

itemModal.addEventListener('show.bs.modal', e => {
    const button = e.relatedTarget
    mode = button.getAttribute('data-bs-mode')
    const modalTitle = itemModal.querySelector('.modal-title')
    modalTitle.textContent = `${mode === 'add' ? 'Добавить' : 'Редактировать'} элемент ToDo`
})

saveButton.addEventListener('click', () => {
    if (modalBodyInput.value.length) {
        if (mode === 'add') {
            create(modalBodyInput.value)
        }
        document.getElementById('cancel-button').click()
    } else {
        alert('Ошибка: пустое значение!')
    }
})

const loadAll = () => {
    $.ajax({
        type: 'GET',
        url: '/all',
        success: res => {
            ownItems = res.data;
            showOwnItems()
        },
        error: (xhr, e) => console.error(e)
    })
}


const prependOwnItem = item => {
    $(`#item-${ownItems[0].id}`).before(listItem(item))
    ownItems.unshift(item)
}

const listItem = item => `<li id='item-${item.id}' class="list-group-item">${item.content}</li>`

const showOwnItems = () => ownItems.map(item => listItem(item)).map(item => $('#own-items').append(item))

$(() => {
    loadAll()
})
