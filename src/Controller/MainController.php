<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Accounts;
use App\Entity\Books;

class MainController extends AbstractController{
     /**
      * @Route("/", name="index")
      */
	public function index() {
		return $this->render('index.html.twig');
	}

	/**
      * @Route("/books", name="books")
      */
	  public function books() {
		$repository = $this->getDoctrine()->getRepository(Books::class);
		$book = $repository->findAll();
		
		return $this->render('book.html.twig', ["book" => $book]);
	}

	/**
      * @Route("/about_us", name="aboutUs")
      */
	  public function aboutUs() {
		return $this->render('staj-site/about_us.html.twig', []);
	}

	/**
      * @Route("/setting", name="setting")
      */
	  public function setting() {
		return $this->render('staj-site/setting.html.twig', []);
	}

	/**
      * @Route("/register", name="register")
      */
	  public function register() {
		return $this->render('staj-site/register.html.twig', []);
	}

	/**
      * @Route("/sign_in", name="signIn")
      */
	  public function signIn() {
		return $this->render('staj-site/sign_in.html.twig', []);
	}

		/**
      * @Route("/show_book", name="showBook")
      */
	  public function showBook(Request $request) {
		$id = $request->request->get('id');
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Books::class)->find($id);
			
		return $this->render('staj-site/show_one_book.html.twig', ["book" => $book]);
	}

	/**
      * @Route("/new_book", name="newBook")
      */
	  public function newBook() {
		return $this->render('staj-site/new_book.html.twig', []);
	}

	/**
     * @Route("/add_new_book", name="addNewBook")
     */
    public function addNewBook(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();

        $book = new Books();
        $book->setName($request->request->get('name'));
		$book->setContent($request->request->get('content'));

        $entityManager->persist($book);
		$entityManager->flush();
		
		return $this->redirectToRoute('books');
    }

	/**
     * @Route("/search_user_name", name="searchUserName")
     */
    public function searchUserName(Request $request) {
		$user_name = $request->request->get('user_name');
		$password = $request->request->get('psw');
		$rep_psw = $request->request->get('psw-repeat');
		$repository = $this->getDoctrine()->getRepository(Accounts::class);
		$account = $repository->searchUserName($user_name);
		if($account) 
			return $this->render('staj-site/error_register.html.twig', []);
		else if(strcmp($password, $rep_psw) != 0) 
			return $this->render('staj-site/psw_dif.html.twig', []);
		else {
			$entityManager = $this->getDoctrine()->getManager();

			$acc = new Accounts();
			$acc->setUserName($user_name);
			$acc->setPassword($password);

			$entityManager->persist($acc);
			$entityManager->flush();
			
			return $this->render('index.html.twig');
		}
	}

	/**
     * @Route("/search_account", name="searchAccount")
     */
    public function searchAccount(Request $request) {
		$user_name = $request->request->get('user_name');
		$password = $request->request->get('psw');
		$repository = $this->getDoctrine()->getRepository(Accounts::class);
		$account = $repository->searchAccount($user_name, $password);
		if($account) 
			return $this->render('index.html.twig');	

		return $this->render('staj-site/err_sign_in.html.twig', []);  
	}
	
	/**
     * @Route("/update_book", name="updateBook")
     */
    public function updateBook(Request $request) {
		$id = $request->request->get('id');
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Books::class)->find($id);
		
		return $this->render('staj-site/update_book.html.twig', ["book" => $book]);
    }
	
	/**
	 * @Route("/update_ready_book", name="updateReadyBook")
	 */
	public function updateReadyBook(Request $request) {
		$id = $request->request->get('id');
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Books::class)->find($id);
		
        $book->setName($request->request->get('name'));
        $book->setContent($request->request->get('content'));
		
		$entityManager->flush();

		return $this->render('staj-site/show_one_book.html.twig', ["book" => $book]);
	}

	/**
	 * @Route("/delete_book", name="deleteBook")
	 */
	public function deleteBook(Request $request) {
		$id = $request->request->get('id');
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Books::class)->find($id);

		$entityManager->remove($book);
		$entityManager->flush();

		return $this->redirectToRoute('books');
	}
}

?>