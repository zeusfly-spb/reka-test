let ownItems = []
const itemModal = document.getElementById('itemModal')
let mode = null
itemModal.addEventListener('show.bs.modal', e => {
    const button = e.relatedTarget
    mode = button.getAttribute('data-bs-mode')
    const modalTitle = itemModal.querySelector('.modal-title')
    modalTitle.textContent = `${mode === 'add' ? 'Добавить' : 'Редактировать'} элемент ToDo`
})
const modalBodyInput = itemModal.querySelector('.modal-body input')
const clearInput = () => modalBodyInput.value = ''
const cancelButton = document.getElementById('cancel-button')
const saveButton = document.getElementById('save-button')
cancelButton.addEventListener('click', clearInput)
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

const create = content => {
    $.ajax({
        type: 'POST',
        url: '/creat',
        data: { "content": content, "_token": "{{ csrf_token() }}" },
        success: res => {
            console.log(res)
        },
        error: (xhr, e) => {
            console.log('Query error ' + e)
        }
    })
}

const loadAll = () => {
    $.ajax({
        type: 'GET',
        url: '/all',
        success: res => {
            ownItems = res.data;
            showOwnItems()
        },
        error: (xhr, e) => console.error(e.message)
    })
}

const listItem = item => `<li id='item-${item.id}' class="list-group-item">${item.content}</li>`

const showOwnItems = () => ownItems.map(item => listItem(item)).map(item => $('#own-items').append(item))

$(() => {
    loadAll()
})
