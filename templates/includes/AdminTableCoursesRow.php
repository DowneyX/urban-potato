<tr>
    <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <?= $course->getId() ?>
    </td>
    <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <?= $course->getCourseName() ?>
    </td>
    <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <?= $course->getYear() ?>
    </td>
    <td class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <?= $course->getExaminorId() ?>
    </td>
    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
        <a href="">
            <span class="inline px-3 py-2 rounded hover:bg-green-900 shadow-lg bg-green-600">
                UPD
            </span>
        </a>
        <a href="">
            <span class="inline px-3 py-2 mx-2 rounded hover:bg-red-900 shadow-lg bg-red-600">
                DEL
            </span>
        </a>
    </td>
</tr>