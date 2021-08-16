//
//  IntroScreenVC.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 23/04/21.
//
import UIKit

struct IntroScreenStruct {
    var IntroImg:UIImage
    var title:String
    var isButtonHide:Bool
}
class IntroScreenVC: UIViewController {
    
    @IBOutlet weak var collectionView: UICollectionView!
    var currentPage:Int?
    var scrView = UIScrollView()
    lazy var introScreenArray1: [IntroScreenStruct] = [ //Open Aby Chalet App
        IntroScreenStruct(IntroImg: UIImage(named: "img_intro1")!, title: "Open Aby Chalet App".localized(), isButtonHide: true),
        IntroScreenStruct(IntroImg: UIImage(named: "img_intro2")!, title: "Select The Date And Find Available chalets".localized(), isButtonHide: true),
        
        IntroScreenStruct( IntroImg: UIImage(named: "img_intro3")!, title: "Payment".localized(), isButtonHide: true),
        
        IntroScreenStruct(IntroImg: UIImage(named: "img_intro4")!, title: "", isButtonHide: false)
    ]
    
    //MARK:-
    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        self.navigationController?.navigationBar.isHidden = true
    }
    
    override func viewWillDisappear(_ animated: Bool) {
        self.navigationController?.navigationBar.isHidden = false
    }
    
    
}

//MARK:- UICollectionViewDelegate & DataSource & DelegateFlowLayout
extension IntroScreenVC : UICollectionViewDelegate, UICollectionViewDataSource, UICollectionViewDelegateFlowLayout {
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
            return introScreenArray1.count
    }

    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {

        switch indexPath.item {
        case 0, 2:
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "IntrolCollectionViewCell", for: indexPath) as! IntrolCollectionViewCell
            cell.indexPathItem = indexPath.item
            cell.introScreenData = introScreenArray1[indexPath.item]
            cell.pageControl.currentPage = indexPath.row
            return cell
        default:
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "IntrolCollectionViewSecondCell", for: indexPath) as! IntrolCollectionViewSecondCell
            cell.indexPathItem = indexPath.item
            cell.introScreenData = introScreenArray1[indexPath.item]
            cell.pageControl.currentPage = indexPath.row

            return cell
        }
        
}

func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize {
    
    return CGSize(width: collectionView.bounds.size.width , height: collectionView.bounds.size.height)
}

func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumLineSpacingForSectionAt section: Int) -> CGFloat {
    return 0
}

}
