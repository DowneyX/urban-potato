<tr>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= $value["user"]->getId() ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= $value["user"]->getEmail() ?>
  </td>
  <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <?= $value["role"]->getRoleName() ?>
  </td>
  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
    <a href="">
      <span class="inline mx-2 px-3 py-2 rounded hover:bg-green-900 shadow-lg bg-green-600">
        UPD
      </span>
    </a>
    <a href="">
      <span class="inline px-3 py-2 rounded hover:bg-red-900 shadow-lg bg-red-600">
        DEL
      </span>
    </a>
  </td>
</tr>