<tr>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["user"]->getId()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["user"]->getEmail()) ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= htmlspecialchars($value["role"]->getRoleName()) ?>
  </td>
  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <a href=<?= $this->getUrlFor("adminEnrollments", [$value["user"]->getId()]) ?>>
      <span class="inline mx-1 px-3 py-2 rounded hover:bg-blue-900 shadow-lg bg-blue-600">
        VIEW ENROLLMENTS
      </span>
    </a>
    <a href=<?= $this->getUrlFor("adminDeleteUser", [$value["user"]->getId()]) ?>>
      <span class="inline mx-1 px-3 py-2 rounded hover:bg-red-900 shadow-lg bg-red-600">
        DEL
      </span>
    </a>
  </td>
</tr>