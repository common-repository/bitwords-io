'use strict';

function getBitwordsPosts () {
  var host = 'https://app.bitwords.io';

  function getHostName (url) {
    var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
    if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) return match[2];
    else return null;
  }

  var $settings = document.getElementById('bitwords-settings');

  var isEnabled = (Number($settings.dataset.afterarticlesenabled) || 1) == 1;
  var numberOfAritclesinRow = Number($settings.dataset.afterarticlesstoresinrow || 3);
  var publisherId = $settings.dataset.publisherid;
  var totalNumberOfAricles = Number($settings.dataset.afterarticlesmaxstories || 6);

  function createHtml (data) {
    var post = '';
    var numberOfPosts = Math.min(data.length, totalNumberOfAricles);

    for (var i = 0; i < numberOfPosts; i++) {
      if (i === 0 || i % numberOfAritclesinRow === 0) {
        post += '<div class="bitwords-set">';
      }

      var id = data[i]._id;
      post += '<a href="' + data[i].redirectUrl + '" class="bitwords-item" target="_blank" data-id="' + id + '">';
      post += '  <div class="bitwords-item-img">';
      post += '    <img class="bitwords-img" src="' + data[i].thumbnailUrl + '" alt="' + data[i].title + '">';
      post += '  </div>';
      post += '  <div class="bitwords-title">' + data[i].title + '</div>';
      post += '  <div class="bitwords-domain">' + getHostName(data[i].url) + '</div>';
      post += '</a>';

      if (i % numberOfAritclesinRow === numberOfAritclesinRow - 1) post += '</div>';
    }

    post += '</div>';
    return post;
  }

  if (!isEnabled) return;

  // load thumbnails when its visible to user
  var loadThumbnailsWhenVisible = function loadThumbnailsWhenVisible() {
    var loadWhenVisible = function loadWhenVisible($list) {
      var isVisible = false;

      function ifVisible() {
        var rect = $list.getBoundingClientRect();
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;
        var $img = $list.getElementsByClassName('bitwords-item-img')[0];

        // This gets triggered once an image comes into full view and triggers an impression
        // w. bitwords
        if (rect.top - windowHeight + $img.clientHeight < 0) {
          isVisible = true;
          var fetchOptions = {
            method: 'POST',
            headers: {
              'x-publisher': publisherId,
              'Content-Type': 'application/json'
            }
          };
          fetch(host + '/r/thumb/' + $list.dataset.id + '/p/' + publisherId, fetchOptions);
        }
      };

      window.addEventListener('scroll', function () {
        if (!isVisible) requestAnimationFrame(ifVisible);
      });
    };

    document.querySelectorAll('.bitwords-item').forEach(loadWhenVisible);
  };

  // todo: convert this to XMLHttpRequest
  var fetchOptions = {
    headers: {
      'x-publisher': publisherId,
      'Content-Type': 'application/json'
    }
  };

  fetch(host + '/api/v1/publishers/posts?count=' + totalNumberOfAricles, fetchOptions)
  .then(function (response) { return response.json(); })
  .then(function (items) {
    document.getElementById('bitwords-container').style.display = 'block';
    document.getElementById('bitwords-generated-list').innerHTML = createHtml(items);
    loadThumbnailsWhenVisible();
  });
}

// todo: fix this to dynamically load HTML widgets as well
getBitwordsPosts();