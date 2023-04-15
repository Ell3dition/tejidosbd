import { disableButtonAnimation, enableButtonAnimation } from "../../helpers/funtions.js"
import { createTableOrganitations, getOrganitations } from "./organitations.js"

export const deleteOrganitation = async (idOrganitation, button) => {

    enableButtonAnimation(button, 'Espere...')
    const {isConfirmed, isDenied} = await Swal.fire({
            title: '¿Seguro que desea eliminar esta organización?',
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
      const url = "Controllers/organitations/organitationsC.php";
      const response = await fetch(url, {
          method: "POST",
          body: new URLSearchParams({ action: 'deleteOrganitation', idOrganitation })
      })

      const data = await response.json()
      console.log(data)
      if (data.state) {
          const data = await getOrganitations();
          createTableOrganitations(data)

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