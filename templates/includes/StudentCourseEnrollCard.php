<li>
    <form action=<?= $this->getUrlFor('enrollPost') ?> method="post"
        class="py-5 px-4 flex justify-between bg-gray-900 rounded">
        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <p class="text-base text-white font-bold tracking-wide">cursus</p>
                <p class="text-sm text-gray-300 font-medium">
                    <?= htmlspecialchars($value["course"]->getCourseName()) ?>
                </p>
            </div>
        </div>

        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <p class="text-base text-white font-bold tracking-wide">jaar</p>
                <p class="text-sm text-gray-300 font-medium">
                    <?= htmlspecialchars($value["course"]->getYear()) ?>
                </p>
            </div>
        </div>

        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <p class="text-base text-white font-bold tracking-wide">examinator</p>
                <p class="text-sm text-gray-300 font-medium">
                    <?= htmlspecialchars($value["examinor"]->getEmail()) ?>
                </p>
            </div>
        </div>
        <input type="hidden" name="courseId" value=<?= htmlspecialchars($value["course"]->getId()) ?>>
        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="">
                <input
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    type="submit" value="inschrijven">
            </div>
        </div>
    </form>
</li>