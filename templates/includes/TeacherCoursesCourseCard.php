<li>
    <a href=<?= $this->getUrlFor("teacherCourse", [$value["course"]->getId()]) ?>>
        <div class="py-5 px-4 my-2 flex justify-between bg-gray-900 rounded">
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
        </div>
    </a>
</li>