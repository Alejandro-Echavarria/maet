import Swal from "sweetalert2";
import "../../../css/swal2.css";

const SaveAlert = (
    msj = "Ok",
    type = "success",
    timer = 10000,
    toast = true,
    title
) => {
    return Swal.fire({
        icon: type,
        title: title,
        text: msj,
        toast: toast,
        position: toast ? "bottom-end" : "center",
        showConfirmButton: false,
        padding: toast && "0.4em",
        showCloseButton: toast && true,
        timer: timer,
        timerProgressBar: true,
        showCancelButton: !toast && true,
        cancelButtonText: "Close",
        focusCancel: !toast && true,
        showClass: {
            backdrop:
                !toast &&
                "bg-gray-900/50 backdrop-blur backdrop-filter opacity-100",
        },
        customClass: {
            cancelButton:
                "inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150",
        },
        buttonsStyling: false,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
};

export default SaveAlert;
