<div class="grid grid-cols-2 gap-4 container mx-auto">
    <div class="mx-auto w-full my-5 container bg-white">
        <h2>inschrijvingen</h2>
        <ul class="flex flex-col">
            <?php
            foreach ($data as $value) {
                include("StudentOverviewEnrollmentCard.php");
            }
            ?>
        </ul>
    </div>

    <div class="mx-auto w-full my-5 container bg-white">
        <h2>cijfers</h2>
        <ul class="flex flex-col">
            <?php
            foreach ($data as $value) {
                if ($value["enrollment"]->getGrade() == null) {
                    continue;
                }
                include("StudentOverviewGradeCard.php");
            }
            ?>
        </ul>
    </div>
</div>