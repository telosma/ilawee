function message(text, type, timeout) {
    new Noty({
		  type: type,
		  layout: 'topRight',
		  theme: 'mint',
		  text: text,
		  maxVisible: 5,
		  timeout: typeof timeout === 'Number' ? timeout : 3000,
		  progressBar: true,
		  closeWith: ['click', 'button'],
		  animation: {
		    open: 'noty_effects_open',
		    close: 'noty_effects_close'
		  },
		  id: false,
		  force: false,
		  killer: false,
		  queue: 'global',
		  container: false,
		  buttons: [],
		  sounds: {
		    sources: [],
		    volume: 1,
		    conditions: []
		  },
		  titleCount: {
		    conditions: []
		  },
		  modal: false
    }).show();
}
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
