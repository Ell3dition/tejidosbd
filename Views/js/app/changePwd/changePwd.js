import { disableButtonAnimation, enableButtonAnimation } from "../../helpers/funtions.js"

const pwdNew = document.querySelector('#pwdNew')
const repeatPwd = document.querySelector('#repeatPwd')

const btnExit = document.querySelector('#exit-btn')

const btnChangePwd = document.querySelector('#changePwd-btn')

const changePwdModal = new bootstrap.Modal(document.getElementById('changePwd-modal'), {
    keyboard: false,
    backdrop: 'static'
  })

document.addEventListener('DOMContentLoaded', ()=>{

    changePwdModal.show()

  
})


btnExit.addEventListener('click', ()=> reiniciarApp())

const reiniciarApp = ()=>window.location = 'exit'

btnChangePwd.addEventListener('click', async ()=>{
    
    const passOne = pwdNew.value
    const passTwo = repeatPwd.value

    const {state, data} = await validaciones(passOne, passTwo)
    if(!state){
        Swal.fire({
            icon:  "error",
            title:  "Opps!",
            text: data,
        })
        return
    }

    enableButtonAnimation(btnChangePwd, 'Espere...')
    const url = "Controllers/helpers/changePassC.php"
    const response = await fetch(url, {
        method:'POST',
        body: new URLSearchParams({action:'changePwd', passOne, passTwo})
    })
    
    const changePassState = await response.json()
    
   
    Swal.fire({
        icon: changePassState.state ? "success" : "error",
        title: changePassState.state ? "Exito" : "Opps!",
        text: changePassState.data,
    })
    disableButtonAnimation(btnChangePwd, 'Cambiar Contraseña')
    
    if(changePassState.state){
        pwdNew.value = ''
        repeatPwd.value = ''
        changePwdModal.hide()
        setTimeout(()=>reiniciarApp(),2000)
    }


}) 


const validaciones = async (passOne, passTwo)=>{
    const minimumPas = 6;

    if(passOne.trim().length < minimumPas ){
        return {
            state: false,
            data: 'El mínimo de la contraseña es de 6 caracteres'
        }
    }

    if(passOne !== passTwo){
        return {
            state: false,
            data: 'Las contraseñas no coinciden'
        }
    }

   
    return {
        state: true,
        data: 'Todo Ok'
    }
}


