function time()
{
  date = new Date;
  hur = date.getHours();
  min = date.getMinutes();
  if( min < 10)
  {
    min = "0"+min;
  }
  if( hur < 10)
  {
    hur = "0"+hur;
  }
  result = ''+hur+':'+min;
  document.getElementById("hour").innerHTML = result;
  setTimeout('time();','1000');
  return true;
}
