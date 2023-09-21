const btnOpenmenu = document.querySelector('.menuAbrirbtn')
const btnExitmenu = document.querySelector('.menuFecharbtn')

const menu = document.querySelector('.menu')

function acaoMenu() {
    console.log(menu.className)
    if(menu.className == 'menu') {
        menu.style.animationName = 'abrirMenu'
        btnOpenmenu.style.animationName = 'btnOpenOP'
        menu.classList.add('menuExit')

        setTimeout(() => {
            btnOpenmenu.style.display = 'none'
            btnOpenmenu.style.animationName = ''
        }, 400)

        setTimeout(() => {
                    btnExitmenu.style.display = 'flex'
                }, 400)
    } else {

        menu.style.animationName = 'fecharMenu'
        btnExitmenu.style.animationName = 'btnOpenEX'
        btnOpenmenu.style.animationName = ''
        setTimeout(() => {
            menu.classList.remove('menuExit')
            btnExitmenu.style.animationName = ''

            btnExitmenu.style.display = 'none'
            btnOpenmenu.style.display = 'flex'
        }, 400)        
    }


}

btnExitmenu.addEventListener('click', acaoMenu)
btnOpenmenu.addEventListener('click', acaoMenu)
