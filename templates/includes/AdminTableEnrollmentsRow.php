<tr>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["enrollment"]->getId()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["student"]->getId()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["student"]->getEmail()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["examinor"]->getId()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["examinor"]->getEmail()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["course"]->getId()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["course"]->getCourseName()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["enrollment"]->getGrade()) ?>
  </td>
  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <a href=<?= $this->getUrlFor("adminDeleteEnrollment", [$value["enrollment"]->getId()]) ?>>
      <span class="inline px-3 py-2 rounded hover:bg-red-900 shadow-lg bg-red-600">
        DEL
      </span>
    </a>
  </td>
</tr>