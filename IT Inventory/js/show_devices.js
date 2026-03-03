//--------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20251228
//   Sort by column
//--------------------------------------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function ()
{
   const table = document.getElementById("devices");
   const headers = table.querySelectorAll("th");
   let defaultColumn = 1
   let sortDirection = false; // true=asc false=desc

   headers[defaultColumn].classList.add("sorted-asc"); // default indicator
   headers.forEach((header, index) =>
   {
      header.style.cursor = "pointer";
      header.addEventListener("click", () =>
      {
         sortTableByColumn(table, index, sortDirection);
         headers[1].classList.add("sorted-desc");
         headers.forEach(h => h.classList.remove("sorted-asc", "sorted-desc")); // Remove old indicators
         header.classList.add(sortDirection ? "sorted-asc" : "sorted-desc"); // Add indicator for current direction
         sortDirection = !sortDirection;
      });
   });

/* -------------------------- */

function sortByPrefixAndLastNumber(aText, bText, asc) {
    // Extract the last number in each string
    const aNumMatch = aText.match(/(\d+)(?!.*\d)/);
    const bNumMatch = bText.match(/(\d+)(?!.*\d)/);

    const aNum = aNumMatch ? parseInt(aNumMatch[1], 10) : null;
    const bNum = bNumMatch ? parseInt(bNumMatch[1], 10) : null;

    // Extract prefix (everything before the last number)
    const aPrefix = aText.replace(/(\d+)(?!.*\d)/, "").trim().toLowerCase();
    const bPrefix = bText.replace(/(\d+)(?!.*\d)/, "").trim().toLowerCase();

    // 1. Sort alphabetically by prefix
    const prefixCompare = aPrefix.localeCompare(bPrefix);
    if (prefixCompare !== 0) {
        return asc ? prefixCompare : -prefixCompare;
    }

    // 2. Sort numerically by last number
    if (aNum !== null && bNum !== null) {
        return asc ? aNum - bNum : bNum - aNum;
    }

    // 3. Fallback to natural text sort
    return asc
        ? aText.localeCompare(bText, undefined, { numeric: true })
        : bText.localeCompare(aText, undefined, { numeric: true });
}

/* -------------------------- */

   function sortTableByColumn(table, column, asc = true)
   {
      const tbody = table.tBodies[0];
      const rows = Array.from(tbody.querySelectorAll("tr"));

      const extractLastNumber = str =>
      {
         const match = str.match(/(\d+)(?!.*\d)/); // last number in string
         return match ? parseInt(match[1], 10) : null;
      };

const sortedRows = rows.sort((a, b) => {
    const aText = a.children[column].innerText.trim();
    const bText = b.children[column].innerText.trim();

    return sortByPrefixAndLastNumber(aText, bText, asc);
});

      tbody.innerHTML = "";
      sortedRows.forEach(row => tbody.appendChild(row));
   }
});
