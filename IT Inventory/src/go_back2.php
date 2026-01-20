<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260116
//   return to previous page
-------------------------------------------------------------------------------------------------->

<p>Returning to the previous page in <span id='countdown'>3</span> seconds…</p>
<script>
   let seconds = 3;
   const countdown = document.getElementById('countdown');
   const timer = setInterval(() =>
   {
      seconds--;
      countdown.textContent = seconds;
      if (seconds <= 0)
      {
         clearInterval(timer);
         history.go(-2);
      }
   }, 1000);
</script>
