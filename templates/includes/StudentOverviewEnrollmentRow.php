<tr>
    <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <?= htmlspecialchars($value["enrollment"]->getId()) ?>
    </td>
    <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <?= htmlspecialchars($value["examinor"]->getEmail()) ?>
    </td>
    <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <?= htmlspecialchars($value["course"]->getCourseName()) ?>
    </td>
</tr>