export const deleteOrganitation = async (idOrganitation) => {
  
    const {isConfirmed, isDenied} = await Swal.fire({
            title: '¿Seguro que desea eliminar esta organización?',
            icon: 'info',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Si, Eliminar',
            denyButtonText: `Nooo.`,
          })
    
    if(!isConfirmed || isDenied ) return
    
          //acion eliminar
}