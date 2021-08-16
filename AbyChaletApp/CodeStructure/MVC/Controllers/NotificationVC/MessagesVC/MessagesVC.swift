//
//  MessagesVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 30/05/21.
//

import UIKit

class MessagesVC: UIViewController {

    @IBOutlet weak var tableviewMessageList: UITableView!
    var arrayMessgateList = [Message_Notifcation]()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if CAUser.currentUser.id != nil {
            self.getmessageList()
        }
        

    }
    
    override func viewWillAppear(_ animated: Bool) {
       // appDelegate.checkBlockStatus()
    }
    

}
extension MessagesVC : UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return  arrayMessgateList.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        /*if indexPath.row == 0{
            let cell = tableView.dequeueReusableCell(withIdentifier: "CancelReservationTVCell", for: indexPath) as! CancelReservationTVCell
            return cell
        }else if indexPath.row == 1{
            let cell = tableView.dequeueReusableCell(withIdentifier: "ChalletTVCell", for: indexPath) as! ChalletTVCell
            return cell
        }else if indexPath.row == 2{
            let cell = tableView.dequeueReusableCell(withIdentifier: "ChalletTextTVCell", for: indexPath) as! ChalletTextTVCell
            return cell
        }else{
            let cell = tableView.dequeueReusableCell(withIdentifier: "CancelPaymentTVCell", for: indexPath) as! CancelPaymentTVCell
            return cell
        }*/
        
        let dict = self.arrayMessgateList[indexPath.row]
        if dict.reservation_status == "reservation_cancelled"{
            let cell = tableView.dequeueReusableCell(withIdentifier: "CancelReservationTVCell", for: indexPath) as! CancelReservationTVCell
            cell.setValuesToFields(dict: dict)
            return cell
        }else{
            /*let cell = tableView.dequeueReusableCell(withIdentifier: "ChalletTVCell", for: indexPath) as! ChalletTVCell
            cell.setValuesToFields(dict: dict)
            return cell*/
            let cell = tableView.dequeueReusableCell(withIdentifier: "ChalletTextTVCell", for: indexPath) as! ChalletTextTVCell
            cell.setValuesToFields(dict: dict)
            return cell
        }
        
    }
    
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        /*if indexPath.row == 0 {
            return 381
        }else if indexPath.row == 1{
            return 175
        }else if indexPath.row == 2{
            return 120
        }else{
            return 381
        }*/
        
        let dict = self.arrayMessgateList[indexPath.row]
        
        if dict.reservation_status == "reservation_cancelled"{
            return 381
        }else{
            return 175
        }
    }
    
}
extension MessagesVC {
    func getmessageList(){
        ServiceManager.sharedInstance.postMethodAlamofire("api/messages", dictionary: ["userid":CAUser.currentUser.id!], withHud: true) { (success, response, error) in
            if success {
                if ((response as! NSDictionary) ["status"] as! Bool) == true {
                    let responseBase = MessageListBase(dictionary: response as! NSDictionary)
                    self.arrayMessgateList = (responseBase?.notifcation)!
                    DispatchQueue.main.async {
                        self.tableviewMessageList.reloadData()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: response!["message"]! as! String)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }
    }
}
