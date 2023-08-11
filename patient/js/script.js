const sidebar = document.querySelector('.sidebar')
const sidebarClose = document.querySelector('#sidebar-close')
const sidebarOpen = document.querySelector('#sidebar-open')
const main = document.querySelector('.main')
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
  // main.classList.remove('full')
})