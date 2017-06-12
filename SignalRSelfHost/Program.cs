using System;
using Microsoft.AspNet.SignalR;
using Microsoft.Owin.Hosting;
using Owin;
using Microsoft.Owin.Cors;
using System.Threading.Tasks;
using System.Collections.Generic;

namespace SignalRSelfHost
{
    class Program
    {
        static void Main(string[] args)
        {
            try
            {
                // This will *ONLY* bind to localhost, if you want to bind to all addresses
                // use http://*:8080 to bind to all addresses. 
                // See http://msdn.microsoft.com/en-us/library/system.net.httplistener.aspx 
                // for more information.
                // WebApplication + signalr ale nie wiem czy to jest sens
                //List<User> userList;
                string url = "http://10.128.50.5:8080";
                //Database db = new Database();
                //Console.WriteLine(db.Count());
                //Console.ReadLine();
                //userList = db.Select();
                //User usr = userList[1];
                //Console.WriteLine(usr.login);
                using (WebApp.Start(url))
                {
                    Console.WriteLine("Server running on {0}", url);
                    Console.ReadLine();
                }
            } catch(Exception ex)
            {
                Console.WriteLine("Server not started! " + ex.Message);
                Console.ReadLine();
            }
        }
    }
    class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            app.UseCors(CorsOptions.AllowAll);
            app.MapSignalR();
            
        }
    }
    public class MyHub : Hub
    {
        private Database db = new Database();
        List<User> userList;
        private readonly static Dictionary<string,string> _connections = new Dictionary<string, string>();
        private readonly static List<User> activeUsers = new List<User>();

        public void Send(string name, string message)
        {
            Clients.All.addMessage(name, message);
        }

        public List<User> GetConnectedUsers() 
        {
            return activeUsers;
        }

        public void SendChatMessage(string who, string name, string message)
        {
            Clients.Group(who).addMessage(name, message, who);
        }

        public async Task JoinRoom(string roomName)
        {
            await Groups.Add(Context.ConnectionId, roomName);
        }



        public override Task OnConnected()
        {
            string name = Context.QueryString["name"];
            string password = Context.QueryString["password"];
            Console.WriteLine(name + " : " + password);
            userList = db.Select();

            foreach (User user in userList)
            {
                if(user.login.Equals("freeGroup"))
                {
                    if (!activeUsers.Exists(x => x.login.Equals("freeGroup")))
                    {
                        Console.WriteLine("Active freeGroup add!");
                        activeUsers.Add(user);
                    }
                }
                if (name.Equals(user.login) && password.Equals(user.password))
                {
                    _connections.Add(Context.ConnectionId, name);
                    activeUsers.Add(user);
                    JoinRoom(name);
                    JoinRoom("freeGroup");
                    Clients.Group(name).addMessage("server", "success");
                    Console.WriteLine("User found!");
                    Console.WriteLine(activeUsers.Count);
                    return base.OnConnected();
                }
            }
            //string anonymous = "anonymous" + _connections.Count;
            name = name + "FREE";
            _connections.Add(Context.ConnectionId, name);
            JoinRoom("freeGroup");
            Clients.Group("freeGroup").addMessage("server", "new connection "+name);
            Console.WriteLine("User not found! Create free account.");
            Console.WriteLine(activeUsers.Count);
            return base.OnConnected();
        }

        public override Task OnDisconnected(bool stopCalled)
        {
            //var name = Context.User.Identity.Name;
            string userDc;
            _connections.TryGetValue(Context.ConnectionId, out userDc);
            Console.WriteLine("User disconnected: "+ userDc);
            _connections.Remove(Context.ConnectionId);
            if (!userDc.Contains("FREE"))
                activeUsers.RemoveAll(delegate (User x) { return x.login.Equals(userDc); });
            Console.WriteLine(activeUsers.Count);
            return base.OnDisconnected(stopCalled); 
        }
    }
}