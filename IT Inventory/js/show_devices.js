//--------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//   2025.12.24
//   Sort by column
//--------------------------------------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
   const table = document.getElementById("devices");
   const headers = table.querySelectorAll("th");
   let defaultColumn = 1
   let sortDirection = false; // true=asc false=desc

   headers[defaultColumn].classList.add("sorted-asc"); // default indicator
   headers.forEach((header, index) => {
      header.style.cursor = "pointer";
      header.addEventListener("click", () => {
         sortTableByColumn(table, index, sortDirection);
         headers[1].classList.add("sorted-desc");
         headers.forEach(h => h.classList.remove("sorted-asc", "sorted-desc")); // Remove old indicators
         header.classList.add(sortDirection ? "sorted-asc" : "sorted-desc"); // Add indicator for current direction
         sortDirection = !sortDirection;
      });
   });

   function sortTableByColumn(table, column, asc = true) {
      const tbody = table.tBodies[0];
      const rows = Array.from(tbody.querySelectorAll("tr"));

      const sortedRows = rows.sort((a, b) => {
         const aText = a.children[column].innerText.trim();
         const bText = b.children[column].innerText.trim();
         const aNum = parseFloat(aText);
         const bNum = parseFloat(bText);

         if (!isNaN(aNum) && !isNaN(bNum)) {
            return asc ? aNum - bNum : bNum - aNum;
         }

         return asc  ? aText.localeCompare(bText) : bText.localeCompare(aText);
      });
      tbody.innerHTML = "";
      sortedRows.forEach(row => tbody.appendChild(row));
   }
});
