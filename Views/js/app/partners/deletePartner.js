import { disableButtonAnimation, enableButtonAnimation } from "../../helpers/funtions.js"
import { getListPartners, renderTable } from "./partners.js"

export const deletePartner = async ( partnerId, button )=>{

    enableButtonAnimation(button, 'Espere...')
    const {isConfirmed, isDenied} = await Swal.fire({
            title: '¿Seguro que desea eliminar este registro?',
            icon: 'info',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Si, Eliminar',
            denyButtonText: `Nooo.`,
          })
    
    if(!isConfirmed || isDenied ) {
      disableButtonAnimation(button, 'Eliminar')
      return
    }
   
    
    try {
        const url = "Controllers/partners/partnersC.php";
        const response = await fetch(url, {
            method: "POST",
            body: new URLSearchParams({ action: 'deletePartner', partnerId })
        })
  
        const data = await response.json()
        if (data.state) {
            const data = await getListPartners();
            renderTable(data)
  
        }
        Swal.fire({
            icon: data.state ? "success" : "error",
            title: data.state ? "Exito" : "Opps!",
            text: data.data,
        })
        disableButtonAnimation(button, 'Eliminar')
      } catch (error) {
        console.error(error)
        disableButtonAnimation(button, 'Eliminar')
      }
}