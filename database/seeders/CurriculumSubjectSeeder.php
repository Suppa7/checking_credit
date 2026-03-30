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
    [ //1
        'id'=>1,'curriculum_type_id'=>1,'subject_category_id'=>1
    ],
    [ //2
        'id'=>2,'curriculum_type_id'=>1,'subject_category_id'=>2
    ],
    [ //3
        'id'=>3,'curriculum_type_id'=>1,'subject_category_id'=>16
    ],
    [ //4
        'id'=>4,'curriculum_type_id'=>2,'subject_category_id'=>1
    ],
    [ //5
        'id'=>5,'curriculum_type_id'=>2,'subject_category_id'=>3
    ],
    [ //6
        'id'=>6,'curriculum_type_id'=>2,'subject_category_id'=>16
    ],
    [ //7
        'id'=>7,'curriculum_type_id'=>3,'subject_category_id'=>1
    ],
    [ //8
        'id'=>8,'curriculum_type_id'=>3,'subject_category_id'=>4
    ],
    [ //9
        'id'=>9,'curriculum_type_id'=>3,'subject_category_id'=>16
    ],
    [ //10
        'id'=>10,'curriculum_type_id'=>4,'subject_category_id'=>1
    ],
    [ //11
        'id'=>11,'curriculum_type_id'=>4,'subject_category_id'=>5
    ],
    [ //12
        'id'=>12,'curriculum_type_id'=>4,'subject_category_id'=>16
    ],
    [ //13
        'id'=>13,'curriculum_type_id'=>5,'subject_category_id'=>1
    ],
    [ //14
        'id'=>14,'curriculum_type_id'=>5,'subject_category_id'=>6
    ],
    [ //15
        'id'=>15,'curriculum_type_id'=>5,'subject_category_id'=>16
    ],
    [ //16
        'id'=>16,'curriculum_type_id'=>6,'subject_category_id'=>1
    ],
    [ //17
        'id'=>17,'curriculum_type_id'=>6,'subject_category_id'=>7
    ],
    [ //18
        'id'=>18,'curriculum_type_id'=>6,'subject_category_id'=>16
    ],
    [ //19
        'id'=>19,'curriculum_type_id'=>7,'subject_category_id'=>1
    ],
    [ //20
        'id'=>20,'curriculum_type_id'=>7,'subject_category_id'=>8
    ],
    [ //21
        'id'=>21,'curriculum_type_id'=>7,'subject_category_id'=>16
    ],
    [ //22
        'id'=>22,'curriculum_type_id'=>8,'subject_category_id'=>1
    ],
    [ //23
        'id'=>23,'curriculum_type_id'=>8,'subject_category_id'=>9
    ],
    [ //24
        'id'=>24,'curriculum_type_id'=>8,'subject_category_id'=>16
    ],
    [ //25
        'id'=>25,'curriculum_type_id'=>9,'subject_category_id'=>1
    ],
    [ //26
        'id'=>26,'curriculum_type_id'=>9,'subject_category_id'=>10
    ],
    [ //27
        'id'=>27,'curriculum_type_id'=>9,'subject_category_id'=>16
    ],
    [ //28
        'id'=>28,'curriculum_type_id'=>10,'subject_category_id'=>1
    ],
    [ //29
        'id'=>29,'curriculum_type_id'=>10,'subject_category_id'=>11
    ],
    [ //30
        'id'=>30,'curriculum_type_id'=>10,'subject_category_id'=>16
    ],
    [ //31
        'id'=>31,'curriculum_type_id'=>11,'subject_category_id'=>1
    ],
    [ //32
        'id'=>32,'curriculum_type_id'=>11,'subject_category_id'=>12
    ],
    [ //33
        'id'=>33,'curriculum_type_id'=>11,'subject_category_id'=>16
    ],
    [ //34
        'id'=>34,'curriculum_type_id'=>12,'subject_category_id'=>1
    ],
    [ //35
        'id'=>35,'curriculum_type_id'=>12,'subject_category_id'=>13
    ],
    [ //36
        'id'=>36,'curriculum_type_id'=>12,'subject_category_id'=>16
    ],
    [ //37
        'id'=>37,'curriculum_type_id'=>13,'subject_category_id'=>1
    ],
    [ //38
        'id'=>38,'curriculum_type_id'=>13,'subject_category_id'=>14
    ],
    [ //39
        'id'=>39,'curriculum_type_id'=>13,'subject_category_id'=>16
    ],
    [ //40
        'id'=>40,'curriculum_type_id'=>14,'subject_category_id'=>1
    ],
    [ //41
        'id'=>41,'curriculum_type_id'=>14,'subject_category_id'=>15
    ],
    [ //42
        'id'=>42,'curriculum_type_id'=>14,'subject_category_id'=>16
    ],

    [ //43
        'id'=>43,'curriculum_type_id'=>15,'subject_category_id'=>17
    ],
    [ //44
        'id'=>44,'curriculum_type_id'=>15,'subject_category_id'=>18
    ],
    [ //45
        'id'=>45,'curriculum_type_id'=>15,'subject_category_id'=>34
    ],
    [ //46
        'id'=>46,'curriculum_type_id'=>16,'subject_category_id'=>17
    ],
    [ //47
        'id'=>47,'curriculum_type_id'=>16,'subject_category_id'=>19
    ],
    [ //48
        'id'=>48,'curriculum_type_id'=>16,'subject_category_id'=>34
    ],
    [ //49
        'id'=>49,'curriculum_type_id'=>17,'subject_category_id'=>17
    ],
    [ //50
        'id'=>50,'curriculum_type_id'=>17,'subject_category_id'=>20
    ],
    [ //51
        'id'=>51,'curriculum_type_id'=>17,'subject_category_id'=>34
    ],
    [ //52
        'id'=>52,'curriculum_type_id'=>18,'subject_category_id'=>17
    ],
    [ //53
        'id'=>53,'curriculum_type_id'=>18,'subject_category_id'=>21
    ],
    [ //54
        'id'=>54,'curriculum_type_id'=>18,'subject_category_id'=>34
    ],
    [ //55
        'id'=>55,'curriculum_type_id'=>19,'subject_category_id'=>17
    ],
    [ //56
        'id'=>56,'curriculum_type_id'=>19,'subject_category_id'=>22
    ],
    [ //57
        'id'=>57,'curriculum_type_id'=>19,'subject_category_id'=>34
    ],
    [ //58
        'id'=>58,'curriculum_type_id'=>20,'subject_category_id'=>17
    ],
    [ //59
        'id'=>59,'curriculum_type_id'=>20,'subject_category_id'=>23
    ],
    [ //60
        'id'=>60,'curriculum_type_id'=>20,'subject_category_id'=>34
    ],
    [ //61
        'id'=>61,'curriculum_type_id'=>21,'subject_category_id'=>17
    ],
    [ //62
        'id'=>62,'curriculum_type_id'=>21,'subject_category_id'=>24
    ],
    [ //63
        'id'=>63,'curriculum_type_id'=>21,'subject_category_id'=>34
    ],
    [ //64
        'id'=>64,'curriculum_type_id'=>22,'subject_category_id'=>17
    ],
    [ //65
        'id'=>65,'curriculum_type_id'=>22,'subject_category_id'=>25
    ],
    [ //66
        'id'=>66,'curriculum_type_id'=>22,'subject_category_id'=>34
    ],
    [ //67
        'id'=>67,'curriculum_type_id'=>23,'subject_category_id'=>17
    ],
    [ //68
        'id'=>68,'curriculum_type_id'=>23,'subject_category_id'=>26
    ],
    [ //69
        'id'=>69,'curriculum_type_id'=>23,'subject_category_id'=>34
    ],
    [ //70
        'id'=>70,'curriculum_type_id'=>24,'subject_category_id'=>17
    ],
    [ //71
        'id'=>71,'curriculum_type_id'=>24,'subject_category_id'=>27
    ],
    [ //72
        'id'=>72,'curriculum_type_id'=>24,'subject_category_id'=>34
    ],
    [ //73
        'id'=>73,'curriculum_type_id'=>25,'subject_category_id'=>17
    ],
    [ //74
        'id'=>74,'curriculum_type_id'=>25,'subject_category_id'=>28
    ],
    [ //75
        'id'=>75,'curriculum_type_id'=>25,'subject_category_id'=>34
    ],
    [ //76
        'id'=>76,'curriculum_type_id'=>26,'subject_category_id'=>17
    ],
    [ //77
        'id'=>77,'curriculum_type_id'=>26,'subject_category_id'=>29
    ],
    [ //78
        'id'=>78,'curriculum_type_id'=>26,'subject_category_id'=>34
    ],
    [ //79
        'id'=>79,'curriculum_type_id'=>27,'subject_category_id'=>17
    ],
    [ //80
        'id'=>80,'curriculum_type_id'=>27,'subject_category_id'=>30
    ],
    [ //81
        'id'=>81,'curriculum_type_id'=>27,'subject_category_id'=>34
    ],
    [ //82
        'id'=>82,'curriculum_type_id'=>28,'subject_category_id'=>17
    ],
    [ //83
        'id'=>83,'curriculum_type_id'=>28,'subject_category_id'=>31
    ],
    [ //84
        'id'=>84,'curriculum_type_id'=>28,'subject_category_id'=>34
    ],
    [ //85
        'id'=>85,'curriculum_type_id'=>29,'subject_category_id'=>17
    ],
    [ //86
        'id'=>86,'curriculum_type_id'=>29,'subject_category_id'=>32
    ],
    [ //87
        'id'=>87,'curriculum_type_id'=>29,'subject_category_id'=>34
    ],
    [ //88
        'id'=>88,'curriculum_type_id'=>30,'subject_category_id'=>17
    ],
    [ //89
        'id'=>89,'curriculum_type_id'=>30,'subject_category_id'=>33
    ],
    [ //90
        'id'=>90,'curriculum_type_id'=>30,'subject_category_id'=>34
    ],
        ];
        foreach ($curriculumSubject as $value) {
            CurriculumSubject::create($value);
        }
    }
}
