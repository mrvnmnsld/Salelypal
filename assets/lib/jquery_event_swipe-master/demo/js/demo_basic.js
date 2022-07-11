let $ = require('jquery');
window.$ = window.jQuery = $;
let swipeSettingsManager = require('../../index.js');
let $document = $(document);

/**
 * Function getUniqueSelector
 * Made by https://stackoverflow.com/users/1911755/raphael-rafatpanah
 * Raphael Rafatpanah on 21 October 2018
 * License CC-BY-SA 3.0
 * https://stackoverflow.com/a/52918984/1356107
 */
let getUniqueSelector = function(node) 
{
  let selector = "";
  while (node.parentElement) {
    const siblings = Array.from(node.parentElement.children).filter(
      e => e.tagName === node.tagName
    );
    selector =
      (siblings.indexOf(node)
        ? `${node.tagName}:nth-of-type(${siblings.indexOf(node) + 1})`
        : `${node.tagName}`) + `${selector ? " > " : ""}${selector}`;
    node = node.parentElement;
  }
  return `html > ${selector.toLowerCase()}`;
}

$document.ready(()=>{
	let $up = $('#moveup'),
	    $down = $('#movedown'),
	    $left = $('#moveleft'),
	    $right = $('#moveright'),
		
		$element_display = $('#element'),
		$direction = $('#direction'),
		$distance = $('#distance'),
		$speed = $('#speed'),
		$duration = $('#duration'),
		$deviation = $('#deviation'),
		
		$body = $('body'),
		$swipefield = $('.swipefield'),
		
		movement = 50;
	
	$swipefield.on('touchstart', (e) => {
		$body.css({
			'overflow-y': 'hidden'
		});
	});
	$swipefield.on('touchend', (e) => {
		$body.css({
			'overflow-y':''
		});
	});
	
	$up.on('swipe.up', (e) => {
		$up.css({
			top: (parseInt($up.css('top'))-movement)+'px'
		});
		setTimeout(() => {
			$up.css({
				top: ''
			});
		}, 2000);
	});
	
	$down.on('swipe.down', (e) => {
		$down.css({
			top: (parseInt($down.css('top'))+movement)+'px'
		});
		setTimeout(() => {
			$down.css({
				top: ''
			});
		}, 2000);
	});
	
	$left.on('swipe.left', (e) => {
		$left.css({
			left: (parseInt($left.css('left'))-movement)+'px'
		});
		setTimeout(() => {
			$left.css({
				left: ''
			});
		}, 2000);
	});
	
	$right.on('swipe.right', (e) => {
		$right.css({
			left: (parseInt($right.css('left'))+movement)+'px'
		});
		setTimeout(() => {
			$right.css({
				left: ''
			});
		}, 2000);
	});
	
	$document.on('swipe.all', (e) => {
		$element_display.text(getUniqueSelector(e.target));
		$direction.text(e.direction);
		$distance.text(Math.round(e.distance));
		$deviation.text(Math.round(e.deviation));
		$duration.text(e.duration);
		$speed.text((e.distance / e.duration).toFixed(3));
	});
});
