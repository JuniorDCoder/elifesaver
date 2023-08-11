const sidebar = document.querySelector('.sidebar')
const sidebarClose = document.querySelector('#sidebar-close')
const sidebarOpen = document.querySelector('#sidebar-open')
const main = document.querySelector('.main')
const modelClose = document.querySelector('.model-close')
const modelClose2 = document.querySelector('.model-close2')
const model = document.querySelector('.model')
const model2 = document.querySelector('.model2')
const modelOpen = document.querySelector('.model-open')
const modelOpen2 = document.querySelector('.model-open2')
console.log(sidebarOpen);
sidebarClose.addEventListener('click', () => {
  sidebar.classList.add('full-sidebar')
  
  main.classList.add('full')
})
sidebarOpen.addEventListener('click', () => {
  console.log(main)
  if (sidebar.classList.contains('full-sidebar')) {
    console.log('full-sidebar');
    sidebar.classList.remove('full-sidebar')
    sidebarClose.classList.remove('none-icon')
    sidebarClose.classList.add('')
  }else{
    console.log("not full-sidebar");
    sidebar.classList.add('full-sidebar')
    sidebarClose.classList.add('none-icon')
  }

})

  modelOpen.addEventListener('click',()=>{
    model.classList.toggle('show-model')
  })
modelOpen2.addEventListener('click',()=>{
    model2.classList.toggle('show-model2')
  })
modelClose.addEventListener('click', ()=>{
  model.classList.toggle('show-model')
})
modelClose2.addEventListener('click', ()=>{
  model2.classList.toggle('show-model2')
})