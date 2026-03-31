<?php

namespace Database\Seeders;

use App\Models\CurriculumSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculumSubject = [
['id'=>1,'curriculum_type_id'=>1,'subject_category_id'=>1],
['id'=>2,'curriculum_type_id'=>1,'subject_category_id'=>2],
['id'=>3,'curriculum_type_id'=>1,'subject_category_id'=>8],
['id'=>4,'curriculum_type_id'=>2,'subject_category_id'=>1],
['id'=>5,'curriculum_type_id'=>2,'subject_category_id'=>6],
['id'=>6,'curriculum_type_id'=>2,'subject_category_id'=>8],
['id'=>7,'curriculum_type_id'=>3,'subject_category_id'=>1],
['id'=>8,'curriculum_type_id'=>3,'subject_category_id'=>2],
['id'=>9,'curriculum_type_id'=>3,'subject_category_id'=>8],
['id'=>10,'curriculum_type_id'=>4,'subject_category_id'=>1],
['id'=>11,'curriculum_type_id'=>4,'subject_category_id'=>6],
['id'=>12,'curriculum_type_id'=>4,'subject_category_id'=>8],
['id'=>13,'curriculum_type_id'=>5,'subject_category_id'=>1],
['id'=>14,'curriculum_type_id'=>5,'subject_category_id'=>2],
['id'=>15,'curriculum_type_id'=>5,'subject_category_id'=>8],
['id'=>16,'curriculum_type_id'=>6,'subject_category_id'=>1],
['id'=>17,'curriculum_type_id'=>6,'subject_category_id'=>6],
['id'=>18,'curriculum_type_id'=>6,'subject_category_id'=>8],
['id'=>19,'curriculum_type_id'=>7,'subject_category_id'=>1],
['id'=>20,'curriculum_type_id'=>7,'subject_category_id'=>3],
['id'=>21,'curriculum_type_id'=>7,'subject_category_id'=>8],
['id'=>22,'curriculum_type_id'=>8,'subject_category_id'=>1],
['id'=>23,'curriculum_type_id'=>8,'subject_category_id'=>4],
['id'=>24,'curriculum_type_id'=>8,'subject_category_id'=>8],
['id'=>25,'curriculum_type_id'=>9,'subject_category_id'=>1],
['id'=>26,'curriculum_type_id'=>9,'subject_category_id'=>7],
['id'=>27,'curriculum_type_id'=>9,'subject_category_id'=>8],
['id'=>28,'curriculum_type_id'=>10,'subject_category_id'=>1],
['id'=>29,'curriculum_type_id'=>10,'subject_category_id'=>6],
['id'=>30,'curriculum_type_id'=>10,'subject_category_id'=>8],
['id'=>31,'curriculum_type_id'=>11,'subject_category_id'=>1],
['id'=>32,'curriculum_type_id'=>11,'subject_category_id'=>3],
['id'=>33,'curriculum_type_id'=>11,'subject_category_id'=>8],
['id'=>34,'curriculum_type_id'=>12,'subject_category_id'=>1],
['id'=>35,'curriculum_type_id'=>12,'subject_category_id'=>5],
['id'=>36,'curriculum_type_id'=>12,'subject_category_id'=>8],
['id'=>37,'curriculum_type_id'=>13,'subject_category_id'=>1],
['id'=>38,'curriculum_type_id'=>13,'subject_category_id'=>2],
['id'=>39,'curriculum_type_id'=>13,'subject_category_id'=>8],
['id'=>40,'curriculum_type_id'=>14,'subject_category_id'=>1],
['id'=>41,'curriculum_type_id'=>14,'subject_category_id'=>6],
['id'=>42,'curriculum_type_id'=>14,'subject_category_id'=>8],
['id'=>43,'curriculum_type_id'=>15,'subject_category_id'=>9],
['id'=>44,'curriculum_type_id'=>15,'subject_category_id'=>13],
['id'=>45,'curriculum_type_id'=>15,'subject_category_id'=>8],
['id'=>46,'curriculum_type_id'=>16,'subject_category_id'=>9],
['id'=>47,'curriculum_type_id'=>16,'subject_category_id'=>14],
['id'=>48,'curriculum_type_id'=>16,'subject_category_id'=>8],
['id'=>49,'curriculum_type_id'=>17,'subject_category_id'=>9],
['id'=>50,'curriculum_type_id'=>17,'subject_category_id'=>17],
['id'=>51,'curriculum_type_id'=>17,'subject_category_id'=>8],
['id'=>52,'curriculum_type_id'=>18,'subject_category_id'=>9],
['id'=>53,'curriculum_type_id'=>18,'subject_category_id'=>12],
['id'=>54,'curriculum_type_id'=>18,'subject_category_id'=>8],
['id'=>55,'curriculum_type_id'=>19,'subject_category_id'=>9],
['id'=>56,'curriculum_type_id'=>19,'subject_category_id'=>16],
['id'=>57,'curriculum_type_id'=>19,'subject_category_id'=>8],
['id'=>58,'curriculum_type_id'=>20,'subject_category_id'=>9],
['id'=>59,'curriculum_type_id'=>20,'subject_category_id'=>10],
['id'=>60,'curriculum_type_id'=>20,'subject_category_id'=>8],
['id'=>61,'curriculum_type_id'=>21,'subject_category_id'=>9],
['id'=>62,'curriculum_type_id'=>21,'subject_category_id'=>14],
['id'=>63,'curriculum_type_id'=>21,'subject_category_id'=>8],
['id'=>64,'curriculum_type_id'=>22,'subject_category_id'=>9],
['id'=>65,'curriculum_type_id'=>22,'subject_category_id'=>13],
['id'=>66,'curriculum_type_id'=>22,'subject_category_id'=>8],
['id'=>67,'curriculum_type_id'=>23,'subject_category_id'=>9],
['id'=>68,'curriculum_type_id'=>23,'subject_category_id'=>14],
['id'=>69,'curriculum_type_id'=>23,'subject_category_id'=>8],
['id'=>70,'curriculum_type_id'=>24,'subject_category_id'=>9],
['id'=>71,'curriculum_type_id'=>24,'subject_category_id'=>15],
['id'=>72,'curriculum_type_id'=>24,'subject_category_id'=>8],
['id'=>73,'curriculum_type_id'=>25,'subject_category_id'=>9],
['id'=>74,'curriculum_type_id'=>25,'subject_category_id'=>16],
['id'=>75,'curriculum_type_id'=>25,'subject_category_id'=>8],
['id'=>76,'curriculum_type_id'=>26,'subject_category_id'=>9],
['id'=>77,'curriculum_type_id'=>26,'subject_category_id'=>11],
['id'=>78,'curriculum_type_id'=>26,'subject_category_id'=>8],
['id'=>79,'curriculum_type_id'=>27,'subject_category_id'=>9],
['id'=>80,'curriculum_type_id'=>27,'subject_category_id'=>11],
['id'=>81,'curriculum_type_id'=>27,'subject_category_id'=>8],
['id'=>82,'curriculum_type_id'=>28,'subject_category_id'=>9],
['id'=>83,'curriculum_type_id'=>28,'subject_category_id'=>11],
['id'=>84,'curriculum_type_id'=>28,'subject_category_id'=>8],
['id'=>85,'curriculum_type_id'=>29,'subject_category_id'=>9],
['id'=>86,'curriculum_type_id'=>29,'subject_category_id'=>12],
['id'=>87,'curriculum_type_id'=>29,'subject_category_id'=>8],
['id'=>88,'curriculum_type_id'=>30,'subject_category_id'=>9],
['id'=>89,'curriculum_type_id'=>30,'subject_category_id'=>13],
['id'=>90,'curriculum_type_id'=>30,'subject_category_id'=>8],
];
        foreach ($curriculumSubject as $value) {
            CurriculumSubject::create($value);
        }
    }
}
