/*==================== SHOW MENU ====================*/
const showMenu = (toggleId, navId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId)
    
    // Valida a existência de variáveis
    if(toggle && nav){
        toggle.addEventListener('click', ()=>{
            // Adicionamos a classe apresentar-menu à tag div com a classe navegacao__menu
            nav.classList.toggle('apresentar-menu')
        })
    }
}
showMenu('nav-toggle','nav-menu')

/*==================== REMOVE MENU MOBILE ====================*/
const navLink = document.querySelectorAll('.navegacao__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    // Quando clicamos em cada navegacao__link, removemos a classe apresentar-menu
    navMenu.classList.remove('apresentar-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*==================== SCROLL SECTIONS ACTIVE LINK ====================*/
const sections = document.querySelectorAll('section[id]')

function scrollActive(){
    const scrollY = window.pageYOffset

    sections.forEach(current =>{
        const sectionHeight = current.offsetHeight
        const sectionTop = current.offsetTop - 50;
        sectionId = current.getAttribute('id')

        if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
            document.querySelector('.navegacao__menu a[href*=' + sectionId + ']').classList.add('link-ativo')
        }else{
            document.querySelector('.navegacao__menu a[href*=' + sectionId + ']').classList.remove('link-ativo')
        }
    })
}
window.addEventListener('scroll', scrollActive)

/*==================== CHANGE BACKGROUND HEADER ====================*/ 
function scrollHeader(){
    const nav = document.getElementById('header')
    // Quando a rolagem é maior que 200 na altura da janela de visualização, adicione a classe scroll-cabecalho à tag de cabeçalho
    if(this.scrollY >= 200) nav.classList.add('scroll-cabecalho'); else nav.classList.remove('scroll-cabecalho')
}
window.addEventListener('scroll', scrollHeader)

/*==================== SCROLL REVEAL ANIMATION ====================*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '30px',
    duration: 2000,
    reset: true
});

sr.reveal(`.home__data, .home__img,
            .cadastro_receitas__data, .cadastro_receitas__img,
            .receitas__content,
            .footer__content`, {
    interval: 200
})