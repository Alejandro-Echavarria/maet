import Swal from 'sweetalert2';
import '../../../css/swal2.css';

const SaveAlert = (msj = 'Ok', type = 'success', timer = 10000) => {
    return Swal.fire({
        icon: type,
        title: msj,
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        padding: '0.4em',
        showCloseButton: true,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
};

export default SaveAlert;
