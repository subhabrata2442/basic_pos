require("../../common/js/bootstrap-5.min.js");
window.$ = window.jQuery = require("jquery");
// require('../../common/js/font-awesome-all.min')
require("../../common/js/font-awesome-5.min");
window.Swal = require("sweetalert2");
window.toastr = require("../../common/js/toastr.min");
// require('../../common/js/select2.min.js')
window.select2 = require("select2");
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
window.ClassicEditor = require("@ckeditor/ckeditor5-build-classic/build/ckeditor");
// $('select').select2();

require("admin-lte");

// window.calender = require('fullcalendar')

import * as Calendar from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
// import interactionPlugin from '@fullcalendar/interaction';

window.FullCalendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.timeGridPlugin = timeGridPlugin;
window.listPlugin = listPlugin;
// window.interactionPlugin = interactionPlugin;
window.daterangepicker = require("daterangepicker");

require("datatables.net-bs4");
require("../../common/js/custom");
require("./custom");