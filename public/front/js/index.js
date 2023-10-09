// ============= nav bar ==========
let sauidiFlag = document.querySelector('#sauidiFlag');
let amircaFlag = document.querySelector('#amircaFlag');

sauidiFlag.addEventListener('click', () => {
    sauidiFlag.classList.add('d-none');
    amircaFlag.classList.remove('d-none');
});
amircaFlag.addEventListener('click', () => {
    amircaFlag.classList.add('d-none');
    sauidiFlag.classList.replace('d-none', 'd-inline');
})