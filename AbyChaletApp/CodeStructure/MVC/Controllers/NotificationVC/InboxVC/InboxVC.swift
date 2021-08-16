//
//  InboxVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 30/05/21.
//

import UIKit

class InboxVC: UIViewController {

    
    @IBOutlet weak var tableViewInbox: UITableView!
    var arrayReservationList = [Reservation_list]()
    var isClicked = false
    var selectedIndx = 0
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if CAUser.currentUser.userstatus == "owner" {
            self.getOwnerInboxDetails(ownerId: "\(CAUser.currentUser.id!)")
        }
    }
    override func viewWillAppear(_ animated: Bool) {
        //appDelegate.checkBlockStatus()
    }

    //MARK:- ButtonActions
    @IBAction func btnRejectAction(_ sender: UIButton) {
        let dict = self.arrayReservationList[sender.tag]
        self.showAcceptReject(message: "Are you sure you want to reject?", isFrom: "reject", bookindID: "\(dict.id!)")
    }
    @IBAction func btnAcceptAction(_ sender: UIButton) {
        let dict = self.arrayReservationList[sender.tag]
        self.showAcceptReject(message: "Are you sure you want to accept?", isFrom: "accept", bookindID: "\(dict.id!)")
    }
    
    func showAcceptReject(message:String,isFrom:String,bookindID:String) {
        let alert = UIAlertController(title: "Message", message: message.localized(), preferredStyle: .alert)
        alert.addAction(UIAlertAction(title: isFrom == "accept" ? "Accept" : "Reject", style: .default, handler: { action in
                self.acceptReject(status: isFrom, bookingId: bookindID)
            
        }))
        alert.addAction(UIAlertAction(title: "Cancel", style: .default, handler: { action in
            
        }))
        self.present(alert, animated: true, completion: nil)
    }
    
}
extension InboxVC : UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return  arrayReservationList.count != 0 ? arrayReservationList.count : 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        if self.arrayReservationList.count > 0{
            /*if indexPath.row == 0 {
                let cell = tableView.dequeueReusableCell(withIdentifier: "InboxAcceptRejectTVCell", for: indexPath) as! InboxAcceptRejectTVCell
                
                return cell
            }else{*/
                let cell = tableView.dequeueReusableCell(withIdentifier: "InboxListTVCell", for: indexPath) as! InboxListTVCell
            cell.setValuesToFields(dict: arrayReservationList[indexPath.row], isClickedOpen: self.isClicked,index: indexPath.row,selectedIdx: self.selectedIndx)
                return cell
            //}
        }else{
            let cell = tableView.dequeueReusableCell(withIdentifier: "NoNotificationTVCell", for: indexPath) as! NoNotificationTVCell
            return cell
        }
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        if self.arrayReservationList.count > 0{
            let dict = arrayReservationList[indexPath.row]
            if dict.booking_status == "Processing"{
                if self.isClicked == false {
                    isClicked = true
                    selectedIndx = indexPath.row
                    tableView.reloadData()
                }else{
                    isClicked = false
                    selectedIndx = indexPath.row
                    tableView.reloadData()
                }
            }
        }
    }
    func tableView(_ tableView: UITableView, didDeselectRowAt indexPath: IndexPath) {
        let dict = arrayReservationList[indexPath.row]
        if dict.booking_status == "Processing"{
            
        }
    }
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if self.arrayReservationList.count > 0{
            /*if indexPath.row == 0 {
             return 371
             }else{*/
            if isClicked == false{
                return 171
            }else{
                if indexPath.row == self.selectedIndx{
                    return 371
                }else{
                    return 171
                }
            }
            //}
        }else{
            return tableView.frame.height
        }
    }
    
}
extension InboxVC {
    
    func getOwnerInboxDetails(ownerId:String) {
        ServiceManager.sharedInstance.postMethodAlamofire("api/owner_chalet", dictionary: ["ownerid":ownerId], withHud: true) { [self] (success, response, error) in
            self.checkBlockStatus()
            if success {
                if response!["status"] as! Bool == true {
                    let jsonBase = OwnerListBase(dictionary: response as! NSDictionary)
                    self.arrayReservationList = (jsonBase?.reservation_list)!
                    DispatchQueue.main.async {
                        self.tableViewInbox.reloadData()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: ((response! as! NSDictionary)["message"] as! String))
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Failed...!")
            }
        }
    }
    
    func checkBlockStatus() {
        if CAUser.currentUser.id != nil {
            ServiceManager.sharedInstance.postMethodAlamofire("api/block_user", dictionary: ["userid": CAUser.currentUser.id!], withHud: true) { [self] (success, response, error) in
                if success {
                    let status = ((response as! NSDictionary)["status"] as! Bool)
                    if status == false{
                        DispatchQueue.main.async {
                            appDelegate.logOut()
                        }
                    }
                }
            }
        }
    }
    
    
}
extension InboxVC{
    
    func acceptReject(status:String,bookingId:String)  {
        ServiceManager.sharedInstance.postMethodAlamofire("api/accept_reject", dictionary: ["status":status,"booking_id":bookingId], withHud: true) { [self] (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    self.isClicked = false
                    self.selectedIndx = 0
                    DispatchQueue.main.async {
                        if CAUser.currentUser.userstatus == "owner" {
                            self.getOwnerInboxDetails(ownerId: "\(CAUser.currentUser.id!)")
                        }
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Failed...!")
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Failed...!")
            }
        }
        
    }
    
    
    
}


//171 - 0
//371 - 0
