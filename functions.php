<?php
function is_teatime($date_array) {
  return $date_array['weekday'] == 'Friday' && $date_array['hours'] >= '16' && $date_array['hours'] <= '18';
}