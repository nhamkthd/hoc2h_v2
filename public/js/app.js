var main = angular.module('Hoc2h',['angular-loading-bar','ngAnimate','ui.bootstrap','ckeditor','ngFileUpload','ngFlash','ngSanitize','ngTagsInput','selector','ngScrollbar','hoc2h-question','hoc2h-test','hoc2h-editTest','hoc2h-user','hoc2h-heading','hoc2h-message']);

angular.element(document).ready(function(){
  $('.loading').fadeOut('slow');
});
main.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })

