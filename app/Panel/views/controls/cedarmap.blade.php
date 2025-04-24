<div {!! $additionalData !!}>
  <?php

  $result = explode("-", $name);
  if (count($result) != 2) xError("نام فیلد نقشه به درستی وارد نشده است ");

  $latName = $result[0];
  $lngName = $result[1];

  if ($object->isEditMode()) {
    $lat = old($latName, $object->$latName);
    $lng = old($lngName, $object->$lngName);
  } else {
    $lat = old($latName, 35.757448286487595);
    $lng = old($lngName, 51.40876293182373);
  }
  $renderText = $view->mapRenderText;
  ?>

    <input type="hidden" value="{{$lat}}" name="{{$latName}}" id="lat">
    <input type="hidden" value="{{$lng}}" name="{{$lngName}}" id="lng">

    <span data-lat="{{$lat}}" data-lng="{{$lng}}" class="hidden btn btn-success" id="{{$name}}">مشاهده</span>
    <div class="map-viewer-text">{!! $renderText !!}</div>
    <div class="map-viewer" id="map{{$name}}"></div>


    <script>
      document.addEventListener("DOMContentLoaded", function () {

        let lat = $("#{{$latName}}").val();
        let lng = $("#{{$lngName}}").val();

        setTimeout(function () {
          setupMap(lat, lng)
        }, 500)

        let marker = null;
        let map;


        function setupMap(oldLat, oldLng) {

          if (oldLat == null) {
            lat = 35.757448286487595;
            lng = 51.40876293182373;
          } else {
            lat = oldLat
            lng = oldLng
          }

          L.cedarmaps.accessToken = "bdc76b61c9c5aeae32fe78c58801184c81e54833";
          let tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;

          map = L.cedarmaps.map('map{{$name}}', tileJSONUrl, {
            scrollWheelZoom: true
          }).addControl(L.cedarmaps.geocoderControl('cedarmaps.streets', {
            keepOpen: false,
            autocomplete: true,
          }))
          map.setView([lat, lng], 15);
          map.addEventListener("click", function (event) {
            let lat1 = event.latlng.lat;
            let lng2 = event.latlng.lng;

            $("#lat").val(lat1)
            $("#lng").val(lng2)

            addMarker(lat1, lng2)
          })

          if (oldLat != null) {
            addMarker(oldLat, oldLng)
          }
          $(".cedarmaps-logo").remove()
        }

        let addMarker = (oldLat, oldlng) => {
          if (marker == null) {
            marker = new L.marker([oldLat, oldlng], {
              draggable: 'true'
            }).addTo(map);

            lat = oldLat
            lng = oldlng

            marker.addEventListener("click", () => {
              marker.remove()
              marker = null
            })
          } else {
            marker.remove()
            marker = null
            addMarker(oldLat, oldlng)
          }
        }


      })
    </script>
</div>