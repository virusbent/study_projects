<?php
require_once 'vendor/autoload.php';

use \AppBundle\Scope;
use \AppBundle\Base\DAO\IStudentDAO;
use \AppBundle\Base\DAO\ICourseDAO;
use \AppBundle\Base\DAO\IAdminDAO;
use \AppBundle\DAO\Courses_StudentsDAO;
use AppBundle\Base\DAO\ICourses_StudentsDAO;
use AppBundle\Base\DAO\IAdminRoleDAO;
use \AppBundle\Base\DAO\IImageDAO;

use \AppBundle\Base\DAO\IStudentService;
use \AppBundle\Base\DAO\IImageService;
use \AppBundle\Base\DAO\IAdminService;

use \AppBundle\Objects\Course;
use \AppBundle\Objects\Student;
use \AppBundle\Objects\Admin;


/**
 * @param array $old
 * @return array|null
 */
function parseOldImages($old){
    $new = [];

    foreach ($old as $img){
        $editedImg = [
            "i_path"    => $img[1],
            "i_thumb"   => $img[2]
        ];
        array_push($new, $editedImg);
    }

    if( count($new) > 0 )
        return $new;
    else
        return null;
}

function parseStudentsCourses($students_courses){
    foreach ($students_courses as $row){
        if($row->cs_course_ID > 7){
            $row->cs_course_ID = mt_rand(1,7);
        }
    }

    return $students_courses;
}



/** @var IStudentDAO $StudentDAO */
//$studentDAO = Scope::skeleton()->get(IStudentDAO::class);
/** @var ICourseDAO $CourseDAO */
$courseDAO = Scope::skeleton()->get(ICourseDAO::class);
/** @var IAdminDAO $AdminDAO */
$adminDAO = Scope::skeleton()->get(IAdminDAO::class);

$imgDAO = Scope::skeleton()->get(IImageDAO::class);

$cs = Scope::skeleton()->get(ICourses_StudentsDAO::class);

$connector = Scope::connector();

// works - saving Student to DB (generated)from array and returning of the generated id
$newStudent = new Student();
$newStudent->fromArray([
    's_name'      => 'Haruz',
    's_email'     => 'haruz@gmail.com',
    's_phone'     => '0528864232'
]);
$studentsService    = Scope::skeleton()->get(IStudentService::class);
//$newStudentID       = $studentsService->saveStudent($newStudent);
//var_dump($newStudentID);die;

// TEST - Update student with new courses
/*$studentToEdit = $studentsService->getStudentByID(3);
var_dump($studentToEdit);die;*/






//works
/*$data = [
    'c_name'        => 'Course_A',
    'c_description' => 'some description',
    'c_img'         => 0];
$newCourse = new Course();
$newCourse->fromArray($data);

$courseDAO->save($newCourse);*/

//works - saving Admin to DB (generated)from array.
/*$newadmin = new Admin();
$newadmin->fromArray([
    'a_name'      => 'Evgeniy',
    'a_email'     => 'evgen@gmail.com',
    'a_phone'     => '0528864255',
    'a_password'  => '123',
    'a_role'      => 1
]);
$adminDAO->save($newadmin);*/


/*$select = Scope::connector()->select();
$select->from('students')->where('s_ID=?', 3);
$result = $select->queryRow();
var_dump($result);*/

// works - pull all the Students that registered in course: Java.
/*$allStudentsOfJava = new Courses_StudentsDAO();
$result = $allStudentsOfJava->getAllStudentsOfCourse(3);
var_dump($result);
foreach ($result as $javaStudentID)
{
    $javaStudent = $studentDAO->load($javaStudentID);
    var_dump($javaStudent);
}*/

// works - pull all Courses that some Student is registered to.
/*$allCoursesOfStudent = new Courses_StudentsDAO();
$result = $allCoursesOfStudent->getAllCoursesOfStudent(3);
var_dump($result);
foreach ($result as $courseID)
{
    $course = $courseDAO->load($courseID);
    var_dump($course);
}*/

/*$service = Scope::skeleton()->get(IStudentService::class);
$count   = $service->getNumberOfStudents();
$student = $service->getStudentByID(3);
var_dump($student);*/

/*$imgService = Scope::skeleton()->get(IImageService::class);
$img        = $imgService->getImageByID(5);

$newImg = 'student_profile3.jpeg';
$imgService->saveImage($newImg);*/

/*$adminService   = Scope::skeleton()->get(IAdminService::class);
$adminRole      = $adminService->getAdminRole(3);
var_dump($adminRole);*/

/*$imgService      = Scope::skeleton()->get(IImageService::class);
$studentsService = Scope::skeleton()->get(IStudentService::class);
$qResult         = $studentsService->getAllStudents();
$objects         = Student::allFromArray($qResult);
//var_dump($objects[0]->s_img);


$service = Scope::skeleton()->get(\AppBundle\Base\DAO\ICourses_StudentsDAO::class);
$courses = array();
$coursesIDs = $service->getAllCoursesOfStudent(7);
foreach ($coursesIDs as $singleCourseId){
    array_push($courses, $courseDAO->load($singleCourseId));
}
var_dump($courses);
die;*/


//$objects = Student::allFromArray($qResult);

//var_dump(json_encode($qResult));


//TODO: insert new students and images and courses to students

$studentsArrJson = '[{
    "s_name": "Kathy Harper",
  "s_email": "kharper0@list-manage.com",
  "s_phone": "351-(947)935-6579",
  "s_img": 1
}, {
    "s_name": "Martha Hill",
  "s_email": "mhill1@google.com.br",
  "s_phone": "60-(322)291-2953",
  "s_img": 2
}, {
    "s_name": "Mary Moreno",
  "s_email": "mmoreno2@yelp.com",
  "s_phone": "86-(318)733-7832",
  "s_img": 3
}, {
    "s_name": "Anna Marshall",
  "s_email": "amarshall3@whitehouse.gov",
  "s_phone": "86-(868)370-4785",
  "s_img": 4
}, {
    "s_name": "Kenneth Hernandez",
  "s_email": "khernandez4@yahoo.com",
  "s_phone": "7-(511)818-8072",
  "s_img": 5
}, {
    "s_name": "Kathleen Gonzalez",
  "s_email": "kgonzalez5@youtu.be",
  "s_phone": "51-(273)721-7322",
  "s_img": 6
}, {
    "s_name": "Marilyn Reynolds",
  "s_email": "mreynolds6@mlb.com",
  "s_phone": "7-(777)401-9759",
  "s_img": 7
}, {
    "s_name": "Jean Allen",
  "s_email": "jallen7@salon.com",
  "s_phone": "7-(836)736-1344",
  "s_img": 8
}, {
    "s_name": "Jack Ward",
  "s_email": "jward8@redcross.org",
  "s_phone": "502-(640)905-5540",
  "s_img": 9
}, {
    "s_name": "Mildred Rodriguez",
  "s_email": "mrodriguez9@sina.com.cn",
  "s_phone": "7-(114)393-8905",
  "s_img": 10
}, {
    "s_name": "Mark Garcia",
  "s_email": "mgarciaa@japanpost.jp",
  "s_phone": "62-(744)370-5798",
  "s_img": 11
}, {
    "s_name": "Sandra Owens",
  "s_email": "sowensb@samsung.com",
  "s_phone": "351-(399)891-8666",
  "s_img": 12
}, {
    "s_name": "Benjamin Nelson",
  "s_email": "bnelsonc@usgs.gov",
  "s_phone": "86-(922)329-9313",
  "s_img": 13
}, {
    "s_name": "David Fields",
  "s_email": "dfieldsd@wiley.com",
  "s_phone": "55-(137)975-0334",
  "s_img": 14
}, {
    "s_name": "Andrea Richards",
  "s_email": "arichardse@wordpress.org",
  "s_phone": "86-(555)922-2167",
  "s_img": 15
}, {
    "s_name": "Todd Ramirez",
  "s_email": "tramirezf@lulu.com",
  "s_phone": "86-(644)142-0585",
  "s_img": 16
}, {
    "s_name": "Jimmy Myers",
  "s_email": "jmyersg@msn.com",
  "s_phone": "7-(188)174-4366",
  "s_img": 17
}, {
    "s_name": "Lillian Taylor",
  "s_email": "ltaylorh@google.pl",
  "s_phone": "62-(181)943-9220",
  "s_img": 18
}, {
    "s_name": "Martin Wells",
  "s_email": "mwellsi@people.com.cn",
  "s_phone": "62-(925)767-0254",
  "s_img": 19
}, {
    "s_name": "Susan Hamilton",
  "s_email": "shamiltonj@cam.ac.uk",
  "s_phone": "389-(872)361-5847",
  "s_img": 20
}]';

$imagesArrJson = '[{
  "i_path": "https://robohash.org/modieteos.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/oditeoscumque.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/quidemquialias.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/voluptatibusanimimagnam.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/laboriosamrecusandaesunt.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/utmollitiadoloremque.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/oditreiciendisprovident.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/nullavoluptatemmolestias.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/earumnobiseum.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/reiciendissuntquibusdam.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/molestiaeetet.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/quosineveniet.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/utminimaqui.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/consequaturquosipsum.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/perspiciatisvoluptatumeos.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/etdelectusconsectetur.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/mollitiaprovidentsit.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/nihilveldoloribus.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/autemofficiaid.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/autdoloremquis.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/sitdistinctiorerum.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/suntrepellendusnostrum.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/quasrationeut.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/utautenim.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/quosinventorevoluptatem.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/quibusdaminventorenobis.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/eiusaliasfuga.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/laudantiumaccusamuseveniet.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/modietin.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/eaquevoluptatemfuga.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/veritatisdoloresexplicabo.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/consequaturmodinisi.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/liberonumquamaccusamus.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/enimidexcepturi.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/itaquereiciendisvelit.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/repellendusminimanesciunt.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/oditeaofficia.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/minimaquibusdamest.jpg?size=50x50&set=set1"
}, {
  "i_path": "https://robohash.org/consequaturestfacere.jpg?size=120x120&set=set1",
  "i_thumb": "https://robohash.org/nonasperioresratione.jpg?size=50x50&set=set1"
}]';

$studentsCoursesArrJson = '[{
  "cs_course_ID": 6,
  "cs_student_ID": 5
}, {
  "cs_course_ID": 3,
  "cs_student_ID": 13
}, {
  "cs_course_ID": 13,
  "cs_student_ID": 16
}, {
  "cs_course_ID": 16,
  "cs_student_ID": 13
}, {
  "cs_course_ID": 19,
  "cs_student_ID": 7
}, {
  "cs_course_ID": 17,
  "cs_student_ID": 1
}, {
  "cs_course_ID": 14,
  "cs_student_ID": 7
}, {
  "cs_course_ID": 5,
  "cs_student_ID": 4
}, {
  "cs_course_ID": 1,
  "cs_student_ID": 19
}, {
  "cs_course_ID": 18,
  "cs_student_ID": 8
}, {
  "cs_course_ID": 14,
  "cs_student_ID": 7
}, {
  "cs_course_ID": 20,
  "cs_student_ID": 1
}, {
  "cs_course_ID": 4,
  "cs_student_ID": 17
}, {
  "cs_course_ID": 17,
  "cs_student_ID": 17
}, {
  "cs_course_ID": 7,
  "cs_student_ID": 17
}, {
  "cs_course_ID": 13,
  "cs_student_ID": 9
}, {
  "cs_course_ID": 17,
  "cs_student_ID": 3
}, {
  "cs_course_ID": 17,
  "cs_student_ID": 17
}, {
  "cs_course_ID": 7,
  "cs_student_ID": 10
}, {
  "cs_course_ID": 4,
  "cs_student_ID": 13
}]';

/*$studentsArr = json_decode($studentsArrJson);
$imagesArr   = json_decode($imagesArrJson);
$studentsCoursesArr = json_decode($studentsCoursesArrJson);
$studentsAndCourses = parseStudentsCourses($studentsCoursesArr);

$save   = $connector->insert();*/

/*foreach ($studentsAndCourses as $course_student){
    $row = array($course_student->cs_course_ID, $course_student->cs_student_ID);
    $save->into("courses_students", ['cs_course_ID', 'cs_student_ID'])->ignore()
        ->values($row)->execute();
}*/



// save new images of students
/*foreach ( $imagesArr as $image ){
    $imgDAO->save($image->i_path, $image->i_thumb);
}*/

// read old images from file and prepare array of edited images
/*$open_file = fopen("old_images_db.txt", 'r') or die("Unable to open file!");
$oldImagesJson = fread($open_file, filesize("old_images_db.txt"));
fclose($open_file);
$oldImagesfromJson = json_decode($oldImagesJson);
$editedImages = parseOldImages($oldImagesfromJson);*/

// save old images back to server
/*foreach ($editedImages as $img){
    //save old images after saving new one
    $save = $imgDAO->save($img['i_path'], $img['i_thumb']);
    echo "*************** SAVED ****************\n\r" . $save;
}*/


$password = "123456";
$hashed = password_hash($password, PASSWORD_BCRYPT);

var_dump($hashed);


$input = "12345";


//var_dump(password_verify($input, $hashed));


class SessionModule
{
    use \Objection\TSingleton;


    private $user = null;


    public function isLoggedIn()
    {
        return !((bool)$this->user);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function login()
    {
        $s = new \Symfony\Component\HttpFoundation\Session\Session();

        if (!$s->has('user_id'))
            return false;

        // $this->user = userDAO->load($s->get('user_id'));

        return $this->isLoggedIn();
    }

    public function logout()
    {
        $s = new \Symfony\Component\HttpFoundation\Session\Session();
        $s->clear();

        $this->user = null;
    }

    public function authorize($id)
    {
        $s = new \Symfony\Component\HttpFoundation\Session\Session();

        $s->set('user_id', $id);
        $this->login();
    }
}



if (isset($_SESSION['user_id']))
{
    $sessionModule->Login($_SESSION['user_id']);

    $sessionModule->getUSer();
}
$_SESSION['user_id'] = $user->id;
