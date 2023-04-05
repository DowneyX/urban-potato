<form action=<?= $this->getUrlFor("teacherCoursePost", [$course->getId()]) ?> method="post">
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
            <input type="number" min=0 max=10 step=0.1 name="grade" value=<?= $value["enrollment"]->getGrade() ?>>
        </td>
        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <div>
                <input type="hidden" name="enrollmentId" value=<?= $value["enrollment"]->getId() ?>>
                <input
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    type="submit" value="cijfer invoeren">
            </div>
        </td>
    </tr>
</form>