<script>
$(document).ready(function() {

  $( function() {
      $('.top, img').tooltip({
      track: true,
      content: function() {
        return $(this).attr('title');
    }
    });
    } );

setArrows();

$(window).on('resize', function() {
  setArrows();
});

$('.search').keyup( function() {
    var val = $(this).val().toLowerCase();
    $('.movies, .posters').stop().removeClass('open');
    $('.content').stop().removeClass('push');
    $('.shows').removeClass('hiddeninmobile');
    $('.show').each(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(val)>-1);
    });
  });

  $('.search').click(function () {
     $(this).select();
     $(this).addClass('focus');
     $('.logo').addClass('hiddeninmobile');
     $('.link').addClass('current');
     $('.show, .movie').removeClass('highlight').removeClass('notintheatre').removeClass('display_none').removeClass('opacity_05');
     $('.showfilter').addClass('display_none');
  });

  $('.search').blur(function () {
    if(!$('.search').val()) {
     $('.search').removeClass('focus');
     $('.logo').removeClass('hiddeninmobile');
     }
  });

function setArrows(){
  var current = $('.movies').scrollLeft();
  var winwidth = $(window).width();
  var maxwidth = $('.movies')[0].scrollWidth - winwidth;
  if (current == 0) {$('.arrow.left').addClass('disabled')} else {$('.arrow.left').removeClass('disabled')}
  if (current >= maxwidth) {$('.arrow.right').addClass('disabled')} else {$('.arrow.right').removeClass('disabled')}
}

if ($.cookie('theme')=='night') {
  $('#css').attr('href','https://<?=$_SERVER["HTTP_HOST"]?>/kinos-night.css?v=<?=$cssversion?>');
} else {
  $('#css').attr('href','https://<?=$_SERVER["HTTP_HOST"]?>/kinos-day.css?v=<?=$cssversion?>');
}

$('.arrow').click(function() {
  var current = $('.movies').scrollLeft();
  var winwidth = $(window).width();
  var maxwidth = $('.movies')[0].scrollWidth - winwidth;
  if($(this).hasClass('right')){
        $('.movies').animate({scrollLeft: current + winwidth}, 800, 'easeInOutCubic', function() {
          current = $('.movies').scrollLeft();
          if (current > 0) {$('.arrow.left').removeClass('disabled')}
          if (current == maxwidth) {$('.arrow.right').addClass('disabled')}
  });
      } else {
        $('.movies').animate({scrollLeft: current - winwidth}, 800, 'easeInOutCubic', function() {
          current = $('.movies').scrollLeft();
          if (current == 0) {$('.arrow.left').addClass('disabled')}
          if (current < maxwidth) {$('.arrow.right').removeClass('disabled')}
  });
      }

    });
$('.movies').on( 'scroll', function(){
  var current = $('.movies').scrollLeft();
  var winwidth = $(window).width();
  var maxwidth = $('.movies')[0].scrollWidth - winwidth;
  if (current == maxwidth) {$('.arrow.right').addClass('disabled')} else {$('.arrow.right').removeClass('disabled')}
  if (current == 0) {$('.arrow.left').addClass('disabled')} else {$('.arrow.left').removeClass('disabled')}
});
$('.movie').click(function(e) {
  $('.link').addClass('current');
  $('.show').removeClass('notintheatre');
  var show = $(this).data('id');
  var title = $(this).data('title');
  if($(this).hasClass('highlight')){
    $('.link').addClass('current');
    $('.show, .movie').removeClass('highlight').removeClass('display_none').removeClass('opacity_05');
    $('.showfilter').addClass('display_none');
  } else {
    $('.showfilter span').text(title);
    $('.showfilter').removeClass('display_none');
    $('.show, .movie').removeClass('highlight display_none opacity_05');
    $(this).addClass('highlight');
    $('.movie[data-id!='+ show +']').addClass('opacity_05');
    $('.show[data-id!='+ show +']').addClass('display_none');
    $('.content').removeClass('push');
    $('.movies').removeClass('open');
    $('button').removeClass('open');
    $('.shows').removeClass('hiddeninmobile');
  }
});

$('.showfilter').click(function(e) {
  $('.link').addClass('current');
  $('.show, .movie').removeClass('highlight').removeClass('notintheatre').removeClass('display_none').removeClass('opacity_05');
  $('.showfilter').addClass('display_none');
});


$('.show').click(function() {
  if($(this).hasClass('showActions')){
    $('img').removeClass('posterClear');
    $(this).removeClass('showActions');
    $('.show').removeClass('opacity_05');
  } else {
    $('.show').removeClass('showActions opacity_05');
    $('img').addClass('posterClear');
    $(this).addClass('showActions');
    $('.show').not(this).addClass('opacity_05');
  }
});

$('.mode').click(function (){
  $(this).addClass('current');
  $('.mode').not(this).removeClass('current');
  if ($(this).hasClass('night')) {
    $('#css').attr('href','https://kinos.ee/<?=dev('dev/')?>kinos-night.css?v=<?=$cssversion?>');
    bakeCookie('night');
  }
  else {
    $('#css').attr('href','https://kinos.ee/<?=dev('dev/')?>kinos-day.css?v=<?=$cssversion?>');
    bakeCookie('day');
  }
});

$(document).keydown(function(e) {
  if (e.keyCode === 9) { // tab
    e.preventDefault();
    $('.search').blur();
    $('.content').stop().toggleClass('push');
    $('.movies').stop().toggleClass('open');
    $('.sidemenu').removeClass('open');
    $('.more').removeClass('open');
    $('.posters').toggleClass('open');
    $('.shows').toggleClass('hiddeninmobile');
    if($('.posters').hasClass('open')){$("html, body").animate({ scrollTop: 0 }, 250);}
  }
  if (e.keyCode === 27) { // esc
    $('.movie').removeClass('opacity_05').removeClass('highlight');
    $('.show').removeClass('display_none').removeClass('opacity_05').removeClass('showActions').removeClass('notintheatre');
    $('img').removeClass('posterClear');
    $('.content').removeClass('push');
    $('.movies').removeClass('open');
    $('.sidemenu').removeClass('open');
    $('button').removeClass('open');
    $('.showfilter').addClass('display_none');
    $('.link').addClass('current');
  }

});

$('button').click(function (){
  $(this).toggleClass('open');
  $('button').not(this).removeClass('open');

  if($(this).hasClass('posters')){
    if($(this).hasClass('open')){$("html, body").animate({ scrollTop: 0 }, 250);}
    $('.content').toggleClass('push');
    $('.sidemenu').removeClass('open');
    $('.movies').toggleClass('open');
    $('.movies').removeClass('hiddeninmobile');
  } else {
    $('.movies').toggleClass('hiddeninmobile');
    $(this).siblings().find('sidemenu').toggleClass('open');
    $('.content').removeClass('push');
    $('.sidemenu').toggleClass('open');
    $('.movies').removeClass('open');
  }

  if($(this).hasClass('open')){
    $('.shows').addClass('hiddeninmobile');
  } else {
    $('.shows').removeClass('hiddeninmobile');
  }

});

$('.fog').click(function() {
  $('.movieinfo, .fog').removeClass('visible');
  $('.movieinfo').html('');
});

if($(window).width() >= 600){
  $('.posters').addClass('open');
  $('.content').addClass('push');
  $('.movies').addClass('open');
  $('.shows').addClass('hiddeninmobile');
}

$('.link').click(function() {
  var theatre = $(this).text();
  filterTheatre(theatre);
  $('.posters').removeClass('open');
  $('.content').removeClass('push');
  $('.movies').removeClass('open');
  $('.shows').removeClass('hiddeninmobile');
});

$('.input').click(function() {
  if (!$(this).hasClass('blank')) {
    $(this).toggleClass('open');
    $(this).siblings('.options').toggleClass('open');
  }
});



function filterTheatre(theatre){
  if ($('.link:contains('+ theatre +')').hasClass('current')){
      $('.link:not(:contains('+ theatre +'))').toggleClass('current');
      $('.show:not(:contains('+ theatre +'))').toggleClass('notintheatre');
  } else {
      $('.link:contains('+ theatre +')').addClass('current');
      $('.link:not(:contains('+ theatre +'))').removeClass('current');
      $('.movie, .show').removeClass('notintheatre');
      $('.show:not(:contains('+ theatre +'))').addClass('notintheatre');
  }
}

function bakeCookie(mode) {
  $.cookie('theme', mode, {
    expires : 14,
    secure  : true,
    domain  : 'kinos.ee',
    path    : '/'
  });
}

<?=dev('/*')?>

$('.buy').click(function() {
	gtag('event', 'GAEvent', {
		'event_category': 'Buy',
		'event_action': $(this).data('theatre'),
		'event_label': $(this).data('title')
	});
});

<?=dev('*/')?>

$('.video').click(function() {
  $('.movieinfo').html('<iframe src="https://www.youtube-nocookie.com/embed/' + $(this).data('video') + '?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>');
  $('.movieinfo, .fog').addClass('visible');
  <?=dev('/*')?>
  gtag('event', 'GAEvent', {
    'event_category': 'Trailer',
    'event_action': $(this).data('theatre'),
    'event_label': $(this).data('title')
  });
  <?=dev('*/')?>
});

<? tooLate(); ?>
<?
if ($tooLate == 1) {
  echo "
  $('.sidemenu').addClass('open');
  $('.more').addClass('open');
  ";
}
?>
});

</script>
