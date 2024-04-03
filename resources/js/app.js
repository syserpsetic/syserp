import "./bootstrap";
import "./vendor/dom";
import "./vendor/tailwind-merge";
import "./vendor/svg-loader";
import jQuery from 'jquery';
window.$ = jQuery;
import 'datatables.net';
//import 'datatables.net-responsive';
import 'datatables.net-dt/css/jquery.dataTables.css'
// Load static files
import.meta.glob(["../images/**"]);
// $(document).ready(function() {
//     $('.datatable').DataTable();
// });

import '../css/fixdatatable/arreglarcasilla.css';